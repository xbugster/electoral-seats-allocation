<?php

/**
 * a test index file.
 * just to test that this is working properly.
 */

$electoralData = array("A" => 15000, "B" => 5400, "C" => 5500, "D" => 5550);
$totalSeats = 15;
$calculator = new ElectoralSeatsAllocator(new HagenbachQuota, $totalSeats, $electoralData);
$calculator->allocate();