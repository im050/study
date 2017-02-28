<?php
/**
 * A question from Segmentfaults.com
 * Rebuild a array, like a tree.
 *
 * @author memory
 */

$array = [
     1 => [ 'k' => 0 ],
     2 => [ 'k' => 1 ],
     3 => [ 'k' => 1 ],
     4 => [ 'k' => 2 ],
     5 => [ 'k' => 4 ],
     6 => [ 'k' => 3 ],
     7 => [ 'k' => 0 ],
     8 => [ 'k' => 6 ]
];


$tree  = [];
$refer = $array;

foreach($array as $key => $val) {
	if (isset($refer[$val['k']])) {
		$refer[$val['k']]['children'][$key] = &$refer[$key];
	} else {
		$tree[$key] = &$refer[$key];
	}
}

print_r($tree);
?>