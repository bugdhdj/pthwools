<?php

use Swoole\Event;

require_once("vendor/autoload.php");

/*
* This example serves to show that pthreads is not needed for execution to take place.
*
* The tests included with this package serve to verify that behaviour between the polyfill and
* pthreads is consistent.
*/
/*$pool = new Pool(4);
$pool->submit(new class extends Threaded implements Collectable {
    private $garbage = false;

    public function run()
    {
        echo "Hello World\n";
        $this->garbage = true;
    }

    public function isGarbage(): bool
    {
        return $this->garbage;
    }
});

while ($pool->collect(function ($task) {
    return $task->isGarbage();
})) continue;

$pool->shutdown();*/


// example pthwools

//class MyThread extends Thread{
//
//    public function run(): void
//    {
//        \Swoole\Coroutine::sleep(1);
//        echo "sleep: hello world \n";
//    }
//}
//
//class MyThread2 extends Thread{
//
//    public function run(): void
//    {
//        echo "hello world \n";
//    }
//}
//$app = new MyThread();
//$app2 = new MyThread2();
//echo "=> Bugdhdj Start \n";
//echo "Run MyThread \n";
//$app->start();
//echo "Run MyThread2 \n";
//$app2->start();
//
//echo "=> Bugdhdj End \n";

$worker = new Worker();

echo "There are currently {$worker->collect()} tasks on the stack to be collected\n";

for ($i = 0; $i < 15; ++$i) {
    $worker->stack(new class extends Threaded {});
}

echo "There are {$worker->collect()} tasks remaining on the stack to be collected\n";

$worker->start();

while ($worker->collect()); // blocks until all tasks have finished executing

echo "There are now {$worker->collect()} tasks on the stack to be collected\n";

$worker->shutdown();
