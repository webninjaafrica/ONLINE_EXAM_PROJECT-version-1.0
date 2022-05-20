<?php


$loop = new Loop(new SelectLoop);
$socket = new Socket('tcp://127.0.0.1:2080', $loop);

$socket->on('data', function($socket, $data) {
    printf("%s", $data);
});
$socket->write('1-100');

$loop->start();



 ?>