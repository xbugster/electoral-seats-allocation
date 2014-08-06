<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 10:17 PM
 */

class ImperialQuota extends QuotaAbstract {
    public function _calculateQuota( $totalSeats, $totalVotes ) {
        return floor( $totalSeats / ( 2 + $totalSeats ) );
    }
}