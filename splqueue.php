<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/5
 * Time: 下午1:58
 */

$queue = new SplQueue();

//push和pop, 后进先出
for($i = 0; $i <= 10; $i++) {
    $queue->push($i);
}

while(!$queue->isEmpty()) {
    echo $queue->pop() . PHP_EOL;
}

//enqueue和dequeue, 先进先出
for($i = 0; $i <= 10; $i++) {
    $queue->enqueue($i);
}

while(!$queue->isEmpty()) {
    echo $queue->dequeue() . PHP_EOL;
}