<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A Decorator for Tests.
 *
 * Use TestDecorator as the base class for defining new
 * tests decorators. Test decorator subclasses can be introduced
 * to add behaviour before or after a tests is run.
 *
 * @since Class available since Release 2.0.0
 */
class PHPUnit_Extensions_TestDecorator extends PHPUnit_Framework_Assert implements PHPUnit_Framework_Test, PHPUnit_Framework_SelfDescribing
{
    /**
     * The Test to be decorated.
     *
     * @var object
     */
    protected $test = null;

    /**
     * Constructor.
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function __construct(PHPUnit_Framework_Test $test)
    {
        $this->test = $test;
    }

    /**
     * Returns a string representation of the tests.
     *
     * @return string
     */
    public function toString()
    {
        return $this->test->toString();
    }

    /**
     * Runs the tests and collects the
     * result in a TestResult.
     *
     * @param PHPUnit_Framework_TestResult $result
     */
    public function basicRun(PHPUnit_Framework_TestResult $result)
    {
        $this->test->run($result);
    }

    /**
     * Counts the number of tests cases that
     * will be run by this tests.
     *
     * @return int
     */
    public function count()
    {
        return count($this->test);
    }

    /**
     * Creates a default TestResult object.
     *
     * @return PHPUnit_Framework_TestResult
     */
    protected function createResult()
    {
        return new PHPUnit_Framework_TestResult;
    }

    /**
     * Returns the tests to be run.
     *
     * @return PHPUnit_Framework_Test
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Runs the decorated tests and collects the
     * result in a TestResult.
     *
     * @param PHPUnit_Framework_TestResult $result
     *
     * @return PHPUnit_Framework_TestResult
     */
    public function run(PHPUnit_Framework_TestResult $result = null)
    {
        if ($result === null) {
            $result = $this->createResult();
        }

        $this->basicRun($result);

        return $result;
    }
}
