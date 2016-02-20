--TEST--
getFunction() throws ConnectionException if parameter is not string.
--SKIPIF--
<?php include("should_run_online_tests.inc"); ?>
--FILE--
<?php
$config = include "sapnwrfc.config.inc";
$c = new \SAPNWRFC\Connection($config);

function test($c, $param) {
    try {
        $c->getFunction($param);
        echo "ok\n";
    } catch(\SAPNWRFC\ConnectionException $e) {
        echo "fail\n";
    }
}

test($c, 'RFC_PING');
test($c, 0);
test($c, []);
test($c, new \stdClass);
--EXPECT--
ok
fail
fail
fail
--XFAIL--
Segfaults when running tests (and only when runnings tests) in zend_mm_alloc_small
