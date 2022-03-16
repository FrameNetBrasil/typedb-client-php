<?php

namespace TypeDb\Tests\Behaviour\Connection;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class DatabaseContext implements Context
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
     * @When connection create database: alice
     */
    public function connectionCreateDatabaseAlice()
    {
        throw new PendingException();
    }

    /**
     * @Then connection has database: alice
     */
    public function connectionHasDatabaseAlice()
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
     * @Then connection has databases:
     */
    public function connectionHasDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When connection create databases in parallel:
     */
    public function connectionCreateDatabasesInParallel(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When connection delete database: alice
     */
    public function connectionDeleteDatabaseAlice()
    {
        throw new PendingException();
    }

    /**
     * @Then connection does not have database: alice
     */
    public function connectionDoesNotHaveDatabaseAlice()
    {
        throw new PendingException();
    }

    /**
     * @When connection delete databases:
     */
    public function connectionDeleteDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then connection does not have databases:
     */
    public function connectionDoesNotHaveDatabases(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When connection delete databases in parallel:
     */
    public function connectionDeleteDatabasesInParallel(TableNode $table)
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
     * @When connection delete database: typedb
     */
    public function connectionDeleteDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @Then connection does not have database: typedb
     */
    public function connectionDoesNotHaveDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @Then session open transaction of type; throws exception: write
     */
    public function sessionOpenTransactionOfTypeThrowsExceptionWrite()
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
     * @When connection delete database; throws exception: typedb
     */
    public function connectionDeleteDatabaseThrowsExceptionTypedb()
    {
        throw new PendingException();
    }
}
