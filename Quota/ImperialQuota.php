<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 10:17 PM
 */
namespace Quota;

use \Abstraction\QuotaAbstract;

class ImperialQuota extends QuotaAbstract {
    public function _calculateQuota( $totalSeats, $totalVotes ) {
        return $totalVotes / ( 2 + $totalSeats );
    }
}