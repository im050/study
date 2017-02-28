<?php
/**
 * 合并数组并去重
 * @author: memory
 */
$a = [
	['id'=>1],
	['id'=>2],
	['id'=>3],
	['id'=>4],
	['id'=>5],
	['id'=>6]
];
$b = [
	['id'=>5],
	['id'=>6],
	['id'=>7],
];
$c = [
	['id'=>8],
	['id'=>9]
];

function array_unique_merge() {
	$params = func_get_args();
	$result = [];
	$hashmap = [];
	$arr_count = count($params);
	for($i = 0; $i<$arr_count; $i++) {
		foreach($params[$i] as $key => $val) {
			$md5 = md5(msgpack_pack($val));
			if (!isset($hashmap[$md5])) {
				$hashmap[$md5] = true;
				$result[] = $val;
			}
		}
	}
	return $result;
}

$arr = array_unique_merge($a, $b, $c);
print_r($arr);

?>