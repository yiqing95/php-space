<?php

$serv = new swoole_server("0.0.0.0", 9501);
$serv->on('connect', function ($serv, $fd){
    echo "Client:Connect.＼n";
});
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, 'Swoole: '.$data);
});
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.＼n";
});
$serv->start();