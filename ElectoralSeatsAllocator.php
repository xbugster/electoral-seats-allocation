<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych
 * Date: 8/6/14
 * Time: 10:21 PM
 *
 * @desc anyone is free to make it's own allocation
 *       as an example i will use electoral compliant allocation:)
 *       as long as calculations using own ways.
 */

class ElectoralSeatsAllocator extends AllocationAbstract {
    public function __construct( QuotaAbstract $quota, $seats = null, $electionData = array() )
    {
        $this->setQuotaInstance($quota);
        $this->setTotalSeats($seats);
        $this->setElectionsData($electionData);
    }

    public function setTotalSeats( $seats = null ) {
        if ( !is_null( $seats ) ) {
            $this->_totalSeats = $seats;
        }
    }

    protected function makeAllocation()
    {

    }
} 