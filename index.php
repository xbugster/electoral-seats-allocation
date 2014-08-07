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

/**
 * Initialization Examples
 */
$calculator = new ElectoralSeatsAllocator(new Quota\HareQuota, $totalSeats, $electoralData);
$hareResult = $calculator->allocate();

$calculator = new ElectoralSeatsAllocator(new Quota\DroopQuota, $totalSeats, $electoralData);
$droopResult = $calculator->allocate();

$calculator = new ElectoralSeatsAllocator(new Quota\HagenbachQuota, $totalSeats, $electoralData);
$hagenbachResult = $calculator->allocate();

$calculator = new ElectoralSeatsAllocator(new Quota\ImperialQuota, $totalSeats, $electoralData);
$imperialResult = $calculator->allocate();


/**
 * Sample Outputs
 */
echo 'Elections Results Based on data sent:<br/>';
echo 'Total seats: ' . $totalSeats . '<br/>';
echo 'Elections Result: <br/>';
echo '<pre>';
var_dump($electoralData);
echo '</pre>';

echo '-----';
echo '<h3>Results</h3>';
echo '-----<br/>';

echo '<h4>Hare Quota Example Result</h4>';
echo '<pre>';
var_dump($hareResult);
echo '</pre>';

echo '<h4>Droop Quota Example Result</h4>';
echo '<pre>';
var_dump($droopResult);
echo '</pre>';

echo '<h4>Hagenbach Quota Example Result</h4>';
echo '<pre>';
var_dump($hagenbachResult);
echo '</pre>';

echo '<h4>Imperial Quota Example Result</h4>';
echo '<pre>';
var_dump($imperialResult);
echo '</pre>';