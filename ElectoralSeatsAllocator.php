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

    public function setTotalSeats( $seats = null )
    {
        if ( !is_null( $seats ) ) {
            $this->_totalSeats = $seats;
        }
    }

    protected function _calculateAutomaticSeats()
    {
        $automaticSeats = array();
        foreach($this->_electionData AS $k => $v) {
            $automaticSeats[$k] = floor($v / $this->_quota);
        }
        return $automaticSeats;
    }

    protected function _calculateRemainders()
    {
        $remainders = array();
        foreach($this->_electionData as $k => $v) {
            $remainders[$k] = fmod($v, 1);
        }
        return arsort($remainders);
    }

    protected function _calculateRemainingSeats($remainders, $freeSeats)
    {
        $spreadedSeats = array();
        $spreadedSeats = array_fill_keys( array_keys( $remainders ), 0 );

        if( $freeSeats === 0 ) {
            return $spreadedSeats;
        }

        foreach($remainders AS $k => $v) {
            $spreadedSeats[$k] = ($freeSeats !== 0 ? ++$spreadedSeats[$k] : 0);
        }
        return $spreadedSeats;
    }

    protected function _sumSeats($automatic, $remaining) {
        $totals = array();
        $totals = array_fill_keys( array_keys( $automatic ), 0 );
        foreach($totals AS $k=>&$v) {
            $v += $automatic[$k] + $remaining[$k];
        }
        return $totals;
    }

    /**
     * @desc execution flow of CONCRETE Implementation
     * @return array
     */
    protected function makeAllocation()
    {
        $automaticSeatsSpread = $this->_calculateAutomaticSeats();
        $remainders = $this->_calculateRemainders();
        $freeSeats = $this->_totalSeats - array_sum( $automaticSeatsSpread );
        $remainingSeatsSpread = $this->_calculateRemainingSeats( $remainders, $freeSeats );
        return $this->_sumSeats($automaticSeatsSpread, $remainingSeatsSpread);
    }
} 