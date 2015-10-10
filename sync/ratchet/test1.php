<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/10
 * Time: 18:10
 */
// ½ûÓÃxdebug À©Õ¹
if(function_exists('xdebug_disable')) {
    xdebug_disable();
}


require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

// Run the server application through the WebSocket protocol on port 8080
$app = new Ratchet\App('localhost', 8080);
$app->route('/chat', new MyChat);
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));

echo 'server is running on port 8080' ;
$app->run();