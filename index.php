<?php

/**
 * Enable errors on screen
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Autoloader
 */
require(dirname(__FILE__).'/tools/SplClassLoader.php');
$autoloader = new SplClassLoader(null, dirname(__FILE__));
$autoloader->register();

/**
 * a test index file.
 * just to test that this is working properly.
 */

$electoralData = array("A" => 15000, "B" => 5400, "C" => 5500, "D" => 5550);
$totalSeats = 15;
$calculator = new ElectoralSeatsAllocator(new Quota\HagenbachQuota, $totalSeats, $electoralData);
$seats = $calculator->allocate();


echo '<pre>';
var_dump($seats);
echo '</pre>';