--TEST--
zend_bailout() from a fatal error will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
memory_limit=1M
--FILE--
<?php
function foo() {
    str_repeat('.', 1024 * 1024 * 2); // 2MB
}

foo();

echo 'You should not see this.';
?>
--EXPECTF--
[BEGIN foo()]

Fatal error: Allowed memory size of 2097152 bytes exhausted%s(tried to allocate %d bytes) in %s on line %d
[END foo(): null]
