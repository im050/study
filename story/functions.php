<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/17
 * Time: 下午1:40
 */

/**
 * 遍历指定Attributes找出对应节点集合
 * @param $nodes
 * @param $attrName
 * @param $attrValue
 * @return array
 */
function getNodesByAttrName($nodes, $attrName, $attrValue) {
    $elements = [];
    foreach($nodes as $node) {
        if ($node->hasAttributes()) {
            foreach($node->attributes as $attr) {
                if ($attr->nodeName == $attrName && $attr->nodeValue == $attrValue ) {
                    $elements[] = $node;
                }
            }
        }
    }
    return $elements;
}

/**
 * 节点分析递归处理
 * @param $nodes
 * @return string
 */
function parseHtml($nodes) {
    $_html = '';
    foreach ($nodes as $node) {
        $nodeName = $node->nodeName;
        $nodeTextContent = $node->textContent;
        $_attrHtml = '';
        if ($node->hasAttributes()) {
            $nodeAttributes = $node->attributes;
            foreach ($nodeAttributes as $attr) {
                $attrName = $attr->nodeName;
                $attrValue = $attr->value;
                $_attrHtml .= "$attrName='$attrValue' ";
            }
            $_attrHtml = " " . rtrim($_attrHtml);
        }
        if ($nodeName == '#text') {
            $_html .= $nodeTextContent;
        } else if ($nodeName != '#text' && $nodeTextContent != '') {
            $_html .= "<{$nodeName}{$_attrHtml}>";
            if ($node->hasChildNodes()) {
                $nodeChildNodes = $node->childNodes;
                $_html .= parseHtml($nodeChildNodes);
            }
            $_html .= "</{$nodeName}>";
        } else {
            $_html .= "<{$nodeName}{$_attrHtml} />";
        }
    }
    //debug_print_backtrace();
    return $_html;
}
