<?php
namespace {
    if (!extension_loaded("pthreads")) {

        class Volatile extends Threaded implements Collectable, IteratorAggregate
        {

        }
    }
}
