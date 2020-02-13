--TEST--
Check if observer is loaded
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--FILE--
<?php
echo 'The extension "observer" is available';
?>
--EXPECT--
The extension "observer" is available
