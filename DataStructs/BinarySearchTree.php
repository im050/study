<?php
/**
 * 二叉查找树的插入,查找,删除
 * @author memory
 */

/**
 * Class TNode
 * 节点类
 */
class TNode
{
    public $lnode = null;
    public $rnode = null;
    public $val = 0;

    public function __construct($val, $lnode = null, $rnode = null)
    {
        $this->val = $val;
        $this->lnode = $lnode;
        $this->rnode = $rnode;
    }
}

/**
 * Class BinarySearchTree
 * 二叉查找树容器
 */
class BinarySearchTree
{

    /**
     * 用于存放根节点
     * @var null|TNode
     */
    protected $head = null;

    /**
     * 内部节点的指向引用
     * @var null|TNode
     */
    protected $pointer = null;

    public function __construct(TNode &$node)
    {
        $this->head = &$node;
        $this->pointer = $this->head;
    }

    /**
     * 重置指针到根节点
     */
    public function rewind()
    {
        $this->pointer = &$this->head;
    }

    /**
     * 插入操作
     * @param $val
     */
    public function insert($val)
    {
        $this->rewind();
        //遍历插入
        while (true) {
            if ($val > $this->pointer->val) {
                //大于当前节点则向右查
                if (!empty($this->pointer->rnode)) {
                    $this->pointer = &$this->pointer->rnode;
                } else {
                    $this->pointer->rnode = new TNode($val);
                    break;
                }
            } else {
                //小于当前节点则向左查
                if (!empty($this->pointer->lnode)) {
                    $this->pointer = &$this->pointer->lnode;
                } else {
                    $this->pointer->lnode = new TNode($val);
                    break;
                }
            }
        }
    }

    /**
     * 查找操作
     * @param $val
     * @return bool|null|TNode
     */
    public function search($val)
    {
        //与插入类似
        $this->rewind();
        while (true) {
            if ($val > $this->pointer->val) {
                if (!empty($this->pointer->rnode)) {
                    $this->pointer = &$this->pointer->rnode;
                } else {
                    return false;
                }
            } else if ($val < $this->pointer->val) {
                if (!empty($this->pointer->lnode)) {
                    $this->pointer = &$this->pointer->lnode;
                } else {
                    return false;
                }
            } else {
                return $this->pointer;
            }
        }
    }

    /**
     * 删除操作
     * @param $val
     * @return bool
     */
    public function delete($val)
    {
        $this->rewind();
        $flag = true;
        $prev_pointer = null;
        //遍历寻找需要被删除的数据
        while (true) {
            if ($val > $this->pointer->val) {
                if (!empty($this->pointer->rnode)) {
                    $prev_pointer = $this->pointer;
                    $this->pointer = &$this->pointer->rnode;
                } else {
                    $flag = false;
                    break;
                }
            } else if ($val < $this->pointer->val) {
                if (!empty($this->pointer->lnode)) {
                    $prev_pointer = $this->pointer;
                    $this->pointer = &$this->pointer->lnode;
                } else {
                    $flag = false;
                    break;
                }
            } else {
                break;
            }
        }

        if ($flag === false) {
            return false;
        }

        if ($this->pointer->rnode == null || $this->pointer->lnode == null) {
            //存在左边
            if ($this->pointer == $prev_pointer->lnode) {
                unset($prev_pointer->lnode);
                $prev_pointer->lnode = $this->pointer->lnode;
            } else {
                unset($prev_pointer->rnode);
                $prev_pointer->rnode = $this->pointer->lnode;
            }
            unset($this->pointer);
        } else if ($this->pointer->rnode != null && $this->pointer->rnode == null) {
            //存在右边分支
            if ($this->pointer == $prev_pointer->lnode) {
                unset($prev_pointer->lnode);
                $prev_pointer->lnode = $this->pointer->rnode;
            } else {
                unset($prev_pointer->rnode);
                $prev_pointer->rnode = $this->pointer->rnode;
            }
            unset($this->pointer);
        } else if ($this->pointer->rnode == null && $this->pointer->lnode == null) {
            //不存在两边分支
            if ($this->pointer == $prev_pointer->lnode) {
                unset($prev_pointer->lnode);
            } else {
                unset($prev_pointer->rnode);
            }
            unset($this->pointer);
        } else {
            //两边都存在分支
            $temp = &$this->pointer;
            //先转向左节点
            $search = &$this->pointer->lnode;
            //一直向右寻找
            while (!empty($search->rnode)) {
                $temp = &$search;
                $search = &$search->rnode;
            }
            $this->pointer->val = $search->val;
            //如果第一次寻找存在右节点
            if ($temp != $this->pointer) {
                //重置右节点
                $temp->rnode = $search->lnode;
            } else {
                //重置左节点
                $temp->lnode = $search->lnode;
            }
        }
    }

}

$tree = new BinarySearchTree(new TNode(1));
$tree->insert(2);
$tree->insert(5);
$tree->insert(7);
$tree->insert(3);
$tree->insert(6);
$tnode = $tree->search(5);
var_dump($tnode);
$tree->delete(5);
var_dump($tree);