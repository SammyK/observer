--TEST--
zend_bailout() from an internal function will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
assert.bail=1
--FILE--
<?php
function foo() {
    assert(false);
}

foo();

echo 'You should not see this.';
?>
--EXPECTF--
[BEGIN foo()]
[BEGIN assert()]

Warning: assert(): assert(false) failed in %s on line %d
[END assert(): null]
[END foo(): null]
