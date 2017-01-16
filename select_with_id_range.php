<?php
/**
 * Batch select from database with big data
 * 只是一个思路例子
 */
$max_per_size = 1000;
$max_id = 10593;
$min_id = 500;
$times = ceil(($max_id - $min_id + 1) / $max_per_size);
$current_min_id = $min_id;
$current_max_id = $min_id + $max_per_size;
for($i = 0; $i<$times; $i++) {
    //$sql = "SELECT * FROM `table` WHERE xx='xx' AND (id>= {$current_min_id} AND id <= {$current_max_id})";
    $current_min_id = $current_max_id + 1;
    $current_max_id = $current_max_id + $max_per_size;
    if ($current_max_id > $max_id) {
        $current_max_id = $max_id;
    }

}
?>