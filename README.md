# pthwools

[![GitHub license](https://img.shields.io/github/license/bugdhdj/pthwools)](https://github.com/bugdhdj/pthwools/blob/master/LICENSE)
<a href="https://packagist.org/packages/bugdhdj/pthwools"><img src="https://img.shields.io/packagist/v/bugdhdj/pthwools" alt="Composer packagist"></a>

*pthwools* aims to satisfy the API requirements of *pthreads* with *swoole*, such that code written to depend on *pthreads* will work when *pthreads* is not, or can not be loaded.

*pthwools* does not implement the same execution model, for obvious reasons, but uses *swoole* coroutine to implement asynchronous code execution and multi-core optimization.

*pthwools* will ONLY fill for v3, behaviour is consistent with v3, which is the version new projects should target.

Testing
------

*pthwools* is distributed with some unit tests, these tests should pass with and without *pthreads* loaded.

Testing *pthwools*

    phpunit tests

If *pthreads* is loaded by your configuration the pthwools will not be used.

Testing code coverage for *pthwools*

	phpdbg -nqrr vendor/bin/phpunit tests --coverage-text
