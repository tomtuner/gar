<?php

/**
 * Autoloader Script for PHPUnit 
 */
include_once('AutoLoader.php');

/**
 * Register Mail Tests and Associated Files (fixtures, stubs, mocks, etc..) 
 */
AutoLoader::registerDirectory('../tests/Mail');

/**
 * Registery Mail Files 
 */
AutoLoader::registerDirectory('../Mail');

?>
