<?php

namespace TypeDb\Tests\Behaviour\Connection;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class SessionContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given connection has been opened
     */
    public function connectionHasBeenOpened()
    {
        throw new PendingException();
    }

    /**
     * @Given connection does not have any database
     */
    public function connectionDoesNotHaveAnyDatabase()
    {
        throw new PendingException();
    }

    /**
     * @When connection create database: typedb
     */
    public function connectionCreateDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @When connection open session for database: typedb
     */
    public function connectionOpenSessionForDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @Then session is null: false
     */
    public function sessionIsNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then session is open: true
     */
    public function sessionIsOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then session has database: typedb
     */
    public function sessionHasDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @When connection open sessions for databases:
     */
    public function connectionOpenSessionsForDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then sessions are null: false
     */
    public function sessionsAreNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then sessions are open: true
     */
    public function sessionsAreOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then sessions have databases:
     */
    public function sessionsHaveDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When connection open sessions in parallel for databases:
     */
    public function connectionOpenSessionsInParallelForDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then sessions in parallel are null: false
     */
    public function sessionsInParallelAreNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then sessions in parallel are open: true
     */
    public function sessionsInParallelAreOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then sessions in parallel have databases:
     */
    public function sessionsInParallelHaveDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When connection create databases:
     */
    public function connectionCreateDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given connection open data session for database: typedb
     */
    public function connectionOpenDataSessionForDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @When session opens transaction of type: write
     */
    public function sessionOpensTransactionOfTypeWrite()
    {
        throw new PendingException();
    }

    /**
     * @Then typeql define; throws exception containing :arg1
     */
    public function typeqlDefineThrowsExceptionContaining($arg1, PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Given connection open schema session for database: typedb
     */
    public function connectionOpenSchemaSessionForDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @Then typeql define
     */
    public function typeqlDefine(PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Then typeql insert; throws exception containing :arg1
     */
    public function typeqlInsertThrowsExceptionContaining($arg1, PyStringNode $string)
    {
        throw new PendingException();
    }
}
