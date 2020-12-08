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

Fatal error: Uncaught AssertionError: assert(false) in %s
Stack trace:
#0 %s: assert(false, 'assert(false)')
#1 %s: foo()
#2 {main}
  thrown in %s on line %d
[END foo(): null]
