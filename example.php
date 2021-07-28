<?php

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

class MyThread extends Thread{

    public function run(): void
    {
        \Swoole\Coroutine::sleep(1);
        echo "sleep: hello world \n";
    }
}

class MyThread2 extends Thread{

    public function run(): void
    {
        echo "hello world \n";
    }
}
$app = new MyThread();
$app2 = new MyThread2();
echo "=> Bugdhdj Start \n";
echo "Run MyThread \n";
$app->start();
echo "Run MyThread2 \n";
$app2->start();

echo "=> Bugdhdj End \n";
