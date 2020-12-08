--TEST--
Internal functions that call userland functions are instrumented
--DESCRIPTION--
Validates @beberlei's concern:
https://github.com/tideways/php-xhprof-extension/pull/96#issuecomment-616098154
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
function double($x) {
    return $x * 2;
}

$doubles = array_map('double', range(1, 10));

var_dump($doubles);
?>
--EXPECT--
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
[BEGIN double()]
[END double(): int]
array(10) {
  [0]=>
  int(2)
  [1]=>
  int(4)
  [2]=>
  int(6)
  [3]=>
  int(8)
  [4]=>
  int(10)
  [5]=>
  int(12)
  [6]=>
  int(14)
  [7]=>
  int(16)
  [8]=>
  int(18)
  [9]=>
  int(20)
}
