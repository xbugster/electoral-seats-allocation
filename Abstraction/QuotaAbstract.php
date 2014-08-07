<?php
/**
 * Created with PhpStorm.
 * User: Valentin Ruskevych <leaderpvp@gmail.com>
 * Date: 8/6/14
 * Time: 8:43 PM
 */
namespace Abstraction;
abstract class QuotaAbstract {
    /**
     * @desc    getQuota - requires to be implemented in concrete class
     * @param   AllocationAbstract $instance
     * @return  integer
     */
    final public function getQuota(AllocationAbstract $instance)
    {
        $instance->setQuota(
            $this->_calculateQuota(
                $instance->getTotalSeats(),
                $instance->getTotalVotes()
            )
        );
    }

    /**
     * @desc    calculateQuota - required concrete implementation in each quota class.
     *          as the quota calculation changes from method to method.
     *
     * @param   int $totalSeats
     * @param   int $totalVotes
     * @return  int
     */
    abstract protected function _calculateQuota($totalSeats, $totalVotes);
} 