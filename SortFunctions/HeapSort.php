<?php

function swap(&$a, &$b)
{
    $a = $a ^ $b;
    $b = $a ^ $b;
    $a = $a ^ $b;
}

function adjustHeap($node, $length, &$arr)
{

    $left_node = 2 * $node + 1;
    $right_node = $left_node + 1;

    if ($left_node > $length) {
        return;
    }

    if ($right_node <= $length && $arr[$right_node] > $arr[$left_node]) {
        $left_node = $right_node;
    }

    if ($arr[$left_node] > $arr[$node]) {
        swap($arr[$left_node], $arr[$node]);
        adjustHeap($left_node, $length, $arr);
    }

}

function heapSort(&$arr)
{
    $length = count($arr) - 1;

    $i = $length >> 1; // $length / 2

    while (true) {
        adjustHeap($i, $length, $arr);
        if ($i > 0) {
            $i--;
        } else {
            if ($length == 0) {
                break;
            }
            swap($arr[$length], $arr[0]);
            $length--;
        }
    }

}


$numbers = [3, 5, 2, 1, 9, 6];

$node = 0;

heapSort($numbers);

//adjustHeap(0, count($numbers) - 1, $numbers);


print_r($numbers);
