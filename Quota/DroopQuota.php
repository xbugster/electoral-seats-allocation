<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 9:57 PM
 */
namespace Quota;

use \Abstraction\QuotaAbstract;

class DroopQuota extends QuotaAbstract {
    public function _calculateQuota( $totalSeats, $totalVotes ) {
        return 1 + ( $totalVotes / ( 1 + $totalSeats ) );
    }
}