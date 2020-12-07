--TEST--
zend_bailout() from within a zend_try will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
// Shutdown functions are wrapped in a zend_try
register_shutdown_function(function () {
    echo 'Shutdown' . PHP_EOL;
    foo();
    echo 'You should not see this.';
});

function foo() {
    echo 'Exiting' . PHP_EOL;
    exit;
}
?>
--EXPECT--
[BEGIN {closure}()]
Shutdown
[BEGIN foo()]
Exiting
[END foo(): null]
[END {closure}(): null]
