<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 8:43 PM
 */

abstract class QuotaAbstract {
    /**
     * @desc    getQuota - requires to be implemented in concrete class
     * @param   AllocationAbstract $instance
     * @return  integer
     */
    public function getQuota(AllocationAbstract $instance)
    {
        return $this->_calculateQuota($instance->getTotalSeats(), $instance->getElectionsData());
    }

    /**
     * @desc    calculateQuota - required concrete implementation in each quota class.
     *          as the quota calculation changes from method to method.
     *
     * @param   int $totalSeats
     * @param   array $data
     * @return  int
     */
    abstract protected function _calculateQuota($totalSeats, $data);
} 