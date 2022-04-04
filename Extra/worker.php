<?php

/*topics:
(Producer side?)
 - Message acknowledgment (ack says -> msg was recieved, processed, and can be deleted
    if not ack,  msg is re-queued
    *if consumer dies mid-process
    basic_consume(4th param, false) -> true means no-ack
    MSG sent back in same channel
(Both sides)
- Message Durability 
    *Saves task if rabbit SERVER QUITES/CRASHES -> saves all tasks in the queue
    queue_declare (3rd param, true) -> must declare new queue, rabbit does NOT redefine existing queue settings
-Fair Dispatch
    *Sets the Max # of tasks a consumer can work on at a time
    basic_qos
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    echo " [x] Done\n";
    $msg->ack();
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>