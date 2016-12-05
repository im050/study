<?php
function gen() {
    yield 'foo';
    yield 'bar';
}
 
$gen = gen();
var_dump($gen->send('something'));