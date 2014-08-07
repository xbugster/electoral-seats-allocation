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

use Abstraction\AllocationAbstract;

class ElectoralSeatsAllocator extends AllocationAbstract {

    /**
     * @desc  Constructor
     * @param \Abstraction\QuotaAbstract $quota
     * @param null                       $seats
     * @param array                      $electionData
     */
    public function __construct( Abstraction\QuotaAbstract $quota, $seats = null, $electionData = array() )
    {
        $this->setQuotaInstance($quota);
        $this->setTotalSeats($seats);
        $this->setElectionsData($electionData);
    }

    /**
     * @desc   setTotalSeats - setter for total amount of seats available
     * @author Valentin Ruskevych
     * @access public
     * @param null|int $seats
     */
    public function setTotalSeats( $seats = null )
    {
        if ( !is_null( $seats ) ) {
            $this->_totalSeats = $seats;
        }
    }

    /**
     * @desc   _calculateAutomaticSeats - calculate automated seats, spreads
     *              seats by natural integers
     *
     * @author Valentin Ruskevych
     * @internal array $this->_electionData
     * @access protected
     * @return array $automaticSeats
     */
    protected function _calculateAutomaticSeats()
    {
        $automaticSeats = array();
        foreach($this->_electionData AS $k => $v) {
            $float = $v / $this->_quota;
            $automaticSeats[$k] = floor($float);
        }
        return $automaticSeats;
    }

    /**
     * @desc   _calculateRemainders - calculates reminders, used after
     *              spreading automatic seats.
     *              required for: spreading the remaining seats
     *
     * @author Valentin Ruskevych
     * @access protected
     * @internal array $this->_electionData
     * @return array $remainders
     */
    protected function _calculateRemainders()
    {
        $remainders = array();
        foreach($this->_electionData as $k => $v) {
            $remainders[$k] = fmod($v / $this->_quota, 1);
        }
        arsort($remainders);
        return $remainders;
    }

    /**
     * @desc   _calculateRemainingSeats - Spreads remaining seats based on supplied
     *              $remainders(generate by _calculateRemainders()) array
     *
     * @author Valentin Ruskevych
     *
     * @param $remainders
     * @param $freeSeats
     * @access protected
     * @return array $spreadSeats
     */
    protected function _calculateRemainingSeats($remainders, $freeSeats)
    {
        $spreadedSeats = array();
        $spreadedSeats = array_fill_keys( array_keys( $remainders ), 0 );

        if( $freeSeats === 0 ) {
            return $spreadedSeats;
        }

        foreach($remainders AS $k => $v) {
            if($freeSeats < 1) {
                continue;
            }
            ++$spreadedSeats[$k];
            --$freeSeats;
        }
        return $spreadedSeats;
    }

    /**
     * @desc   _sumSeats - typical sum of 2 associative arrays'
     *              values under the same keys
     * @author Valentin Ruskevych
     *
     * @param array $automatic automatically spread seats
     * @param array $remaining remaining seats spread
     *
     * @return array $totals Total Allocated Seats
     */
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
     * @return array total allocated seats
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