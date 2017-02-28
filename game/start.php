<?php
/**
 * Unlock The Password
 * @description: Run with CLI
 * @author: memory <service@im050.com>
 */

include('Console.php');
include('functions.php');

$console = Console::getInstance();

/**
 * Begin
 */
$console->worker('begin', function ($console) {
    $random = getNonRepetitiveNumbers(4, 0, 9);
    $console->assign("random", $random);
    $console->changeWorker('user_input')->run();
});

/**
 * Handle user input.
 */
$console->worker('user_input', function ($console, $data) {
    $user_input = array();
    $input_number = 0;
    for ($i = 0; $i < 4; $i++) {
        $console->getInput("请输入第 " . ($i + 1) . " 个数字:", $input_number, 'intval');
        preg_match("/^[0-9]$/", $input_number, $matches);
        if (!$matches) {
            $i--;
            $console->println("请输入0-9之间的整数");
        } else if (in_array($input_number, $user_input)) {
            $i--;
            $console->println("输入的数字重复了");
        } else {
            array_push($user_input, $input_number);
        }
    }
    $console->changeWorker('valid_result')->render(compact("user_input"))->run();
});

/**
 * Check user input
 */
$console->worker('valid_result', function ($console, $data) {
    $user_input = $data['user_input'];
    $result = $console->getVariable('random');
    $check_result = checkRightAndPosition($user_input, $result);
    if ($check_result === true) {
        $console->println("恭喜你,答对了正确答案");
    } else {
        list($position_right, $number_right) = $check_result;
        $valid_results = $console->getVariable('valid_results');
        if ($valid_results == null) {
            $valid_results = array();
        }
        array_push($valid_results, array($user_input, $position_right, $number_right));
        $console->assign('valid_results', $valid_results);
        $console->println("您的游戏结果:\r\n");
        $console->println(getValidResultsText($valid_results));
        $console->changeWorker('user_input')->run();
    }
});

$console->start('begin');
