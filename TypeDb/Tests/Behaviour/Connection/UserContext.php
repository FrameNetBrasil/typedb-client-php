<?php

namespace TypeDb\Tests\Behaviour\Connection;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class UserContext implements Context
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
     * @Given users contains: admin
     */
    public function usersContainsAdmin()
    {
        throw new PendingException();
    }

    /**
     * @Then users not contains: user
     */
    public function usersNotContainsUser()
    {
        throw new PendingException();
    }

    /**
     * @Then users create: user, password
     */
    public function usersCreateUserPassword()
    {
        throw new PendingException();
    }

    /**
     * @Then users contains: user
     */
    public function usersContainsUser()
    {
        throw new PendingException();
    }

    /**
     * @Then user password: user, new-password
     */
    public function userPasswordUserNewPassword()
    {
        throw new PendingException();
    }

    /**
     * @Then user connect: user, new-password
     */
    public function userConnectUserNewPassword()
    {
        throw new PendingException();
    }

    /**
     * @Then user delete: user
     */
    public function userDeleteUser()
    {
        throw new PendingException();
    }

    /**
     * @Then users not contains: users
     */
    public function usersNotContainsUsers()
    {
        throw new PendingException();
    }
}
