<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 10:14 PM
 */

class HagenbachQuota extends QuotaAbstract {
    public function _calculateQuota( $totalSeats, $totalVotes ) {
        return floor( $totalSeats / ( 1 + $totalSeats ) );
    }
}