<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/25
 * Time: 11:45
 */


require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');

use Symfony\Component\Stopwatch\Stopwatch;

$stopwatch = new Stopwatch();
// Start event named 'eventName'
$stopwatch->start('eventName');
// ... some code goes here
$event = $stopwatch->stop('eventName');

$stopwatch = new Stopwatch();
// Start event named 'foo'
$stopwatch->start('foo');
// ... some code goes here
$stopwatch->lap('foo');
// ... some code goes here
$stopwatch->lap('foo');
// ... some other code goes here
$event = $stopwatch->stop('foo');

print_r(
    $event->getPeriods()
);

$category = $event->getCategory();   // Returns the category the event was started in
$origin = $event->getOrigin();     // Returns the event start time in milliseconds
 $event->ensureStopped(); // Stops all periods not already stopped
$startTime = $event->getStartTime();  // Returns the start time of the very first period
$endTime = $event->getEndTime();    // Returns the end time of the very last period
$duration = $event->getDuration();   // Returns the event duration, including all periods
$memory = $event->getMemory();     // Returns the max memory usage of all periods

print_r(compact('category','origin','startTime','endTime','duration','memory')) ;

$stopwatch = new Stopwatch();

$stopwatch->openSection();
$stopwatch->start('parsing_config_file', 'filesystem_operations');
$stopwatch->stopSection('routing');

$events = $stopwatch->getSectionEvents('routing');
print_r($events);

