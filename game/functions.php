<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/26
 * Time: 下午2:06
 */


/**
 * 校验数字的位置与正确性
 * @param $user_input
 * @param $result
 * @return array|bool
 */
function checkRightAndPosition($user_input, $result)
{
    if ($user_input == $result) {
        return true;
    } else {
        $hash_map = [];
        foreach ($result as $pos => $value) {
            $hash_map[$value] = $pos;
        }
        $number_right = 0;
        $position_right = 0;
        foreach ($user_input as $pos => $value) {
            if (isset($hash_map[$value])) {
                if ($hash_map[$value] == $pos) {
                    $position_right++;
                } else {
                    $number_right++;
                }
            }
        }
    }
    return array($position_right, $number_right);
}

/**
 * 生成不重复的数字
 * @param int $quantity
 * @param int $min
 * @param int $max
 * @return array
 */
function getNonRepetitiveNumbers($quantity = 4, $min = 0, $max = 9)
{
    $exists_map = [];
    $result = [];
    for ($i = 0; $i < $quantity; $i++) {
        $value = mt_rand($min, $max);
        if (isset($exists_map[$value])) {
            $i--;
            continue;
        } else {
            $exists_map[$value] = $quantity;
            array_push($result, $value);
        }
    }
    return $result;
}

function getValidResultsText($valid_results)
{
    $text = '';
    foreach ($valid_results as $key => $item) {
        $text .= implode(",", $item[0]) . " P: " . $item[1] . " N: " . $item[2] . PHP_EOL;
    }
    return $text;
}