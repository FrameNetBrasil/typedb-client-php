<?php

namespace TypeDb\Tests\Behaviour\Connection;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class TransactionContext implements Context
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
     * @Given connection open session for database: typedb
     */
    public function connectionOpenSessionForDatabaseTypedb()
    {
        throw new PendingException();
    }

    /**
     * @When session opens transaction of type: read
     */
    public function sessionOpensTransactionOfTypeRead()
    {
        throw new PendingException();
    }

    /**
     * @Then session transaction is null: false
     */
    public function sessionTransactionIsNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then session transaction is open: true
     */
    public function sessionTransactionIsOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then session transaction has type: read
     */
    public function sessionTransactionHasTypeRead()
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
     * @Then session transaction has type: write
     */
    public function sessionTransactionHasTypeWrite()
    {
        throw new PendingException();
    }

    /**
     * @Then session transaction commits
     */
    public function sessionTransactionCommits()
    {
        throw new PendingException();
    }

    /**
     * @Then session transaction commits; throws exception
     */
    public function sessionTransactionCommitsThrowsException()
    {
        throw new PendingException();
    }

    /**
     * @When for each session, open transaction of type: write
     */
    public function forEachSessionOpenTransactionOfTypeWrite()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction commits
     */
    public function forEachSessionTransactionCommits()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction commits; throws exception
     */
    public function forEachSessionTransactionCommitsThrowsException()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction closes
     */
    public function forEachSessionTransactionCloses()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction is open: false
     */
    public function forEachSessionTransactionIsOpenFalse()
    {
        throw new PendingException();
    }

    /**
     * @When for each session, open transactions of type:
     */
    public function forEachSessionOpenTransactionsOfType(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions are null: false
     */
    public function forEachSessionTransactionsAreNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions are open: true
     */
    public function forEachSessionTransactionsAreOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions have type:
     */
    public function forEachSessionTransactionsHaveType(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When for each session, open transactions in parallel of type:
     */
    public function forEachSessionOpenTransactionsInParallelOfType(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions in parallel are null: false
     */
    public function forEachSessionTransactionsInParallelAreNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions in parallel are open: true
     */
    public function forEachSessionTransactionsInParallelAreOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transactions in parallel have type:
     */
    public function forEachSessionTransactionsInParallelHaveType(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given connection open sessions for database:
     */
    public function connectionOpenSessionsForDatabase(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @When for each session, open transaction of type: read
     */
    public function forEachSessionOpenTransactionOfTypeRead()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction is null: false
     */
    public function forEachSessionTransactionIsNullFalse()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction is open: true
     */
    public function forEachSessionTransactionIsOpenTrue()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction has type: read
     */
    public function forEachSessionTransactionHasTypeRead()
    {
        throw new PendingException();
    }

    /**
     * @Then for each session, transaction has type: write
     */
    public function forEachSessionTransactionHasTypeWrite()
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
     * @Then typeql define; throws exception containing :arg1
     */
    public function typeqlDefineThrowsExceptionContaining($arg1, PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Then transaction commits; throws exception
     */
    public function transactionCommitsThrowsException()
    {
        throw new PendingException();
    }

    /**
     * @Then set session option session-idle-timeout-millis to: :arg1
     */
    public function setSessionOptionSessionIdleTimeoutMillisTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given set transaction option transaction-timeout-millis to: :arg1
     */
    public function setTransactionOptionTransactionTimeoutMillisTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then wait :arg1 seconds
     */
    public function waitSeconds($arg1)
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
}
