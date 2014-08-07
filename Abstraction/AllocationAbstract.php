<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 8:44 PM
 */

abstract class AllocationAbstract {

    /**
     * @desc    Container for elections data array, containing data
     *          structure:
     *          "party_name" => "amount of votes" (ex. array("Democratical Party" => 18329); )
     *
     * @var     array
     */
    protected $_electionData = array();

    /**
     * @desc    Placeholder for total seats amount
     *
     * @var     int
     */
    protected $_totalSeats = 0;

    /**
     * @desc    Placeholder for Quota Implementation
     *          Relies on Interface - strict stick to SOLID is a must.
     *
     * @var     null|QuotaAbstract
     */
    protected $_quota = null;

    /**
     * @desc    allocate - implements Template Pattern to stick developers to exact
     *                  execution flow, however concrete implementation may be altered by parent.
     *
     * @return  array
     */
    final public function allocate() {
        $this->_quota->getQuota($this->_electionData, $this);
        return $this->makeAllocation();
    }

    abstract protected function makeAllocation();

    /**
     * @desc    setQuota - quota setter, forces to pass QuotaInterface'd instance.
     *
     * @param   QuotaAbstract $quota
     */
    public function setQuota(QuotaAbstract $quota)
    {
        $this->_quota = $quota;
    }

    /**
     * @desc    getter. required for different components abstraction
     *
     * @return  int
     */
    public function getTotalSeats() {
        return $this->_totalSeats;
    }

    /**
     * @desc    getter. required for different components abstraction
     *
     * @return  int
     */
    public function getElectionsData() {
        return $this->_electionData;
    }
} 