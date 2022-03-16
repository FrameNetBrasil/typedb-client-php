<?php

namespace TypeDb\Client\Common\Exception;

class ErrorMessage
{
    public static function ShowErrorMessage(string $codePrefix, string $messagePrefix, int $codeNumber, string $messageBody, ...$parameters)
    {
        //return sprintf(codePrefix, codeNumber, messagePrefix, messageBody);
        return sprintf("%s %s %s %s %s", $codePrefix, $codeNumber, $messagePrefix, $messageBody, $parameters[0]);
    }

    public static function CLIENT_CLOSED()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 1, "The client has been closed and no further operation is allowed.");
    }

    public static function SESSION_CLOSED()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 2, "The session has been closed and no further operation is allowed.");
    }

    public static function TRANSACTION_CLOSED()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 3, "The transaction has been closed and no further operation is allowed.");
    }

    public static function TRANSACTION_CLOSED_WITH_ERRORS()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 4, "The transaction has been closed with error(s): \n%s.");
    }

    public static function UNABLE_TO_CONNECT()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 5, "Unable to connect to TypeDB server.");
    }

    public static function NEGATIVE_VALUE_NOT_ALLOWED()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 6, "Value cannot be less than 1, was: '%d'.");
    }

    public static function MISSING_DB_NAME()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 7, "Database name cannot be null.");
    }

    public static function DB_DOES_NOT_EXIST($name)
    {
        return self::ShowErrorMessage("CLI", "Client Error", 8, "The database '%s' does not exist.", $name);
    }

    public static function MISSING_RESPONSE()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 9, "Unexpected empty response for request ID '%s'.");
    }

    public static function UNKNOWN_REQUEST_ID()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 10, "Received a response with unknown request id '%s':\n%s");
    }

    public static function CLUSTER_NO_PRIMARY_REPLICA_YET()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 11, "No replica has been marked as the primary replica for latest known term '%d'.");
    }

    public static function CLUSTER_UNABLE_TO_CONNECT()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 12, "Unable to connect to TypeDB Cluster. Attempted connecting to the cluster members, but none are available: '%s'.");
    }

    public static function CLUSTER_REPLICA_NOT_PRIMARY()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 13, "The replica is not the primary replica.");
    }

    public static function CLUSTER_ALL_NODES_FAILED()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 14, "Attempted connecting to all cluster members, but the following errors occurred: \n%s.");
    }

    public static function CLUSTER_USER_DOES_NOT_EXIST()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 15, "The user '%s' does not exist.");
    }

    public static function CLUSTER_TOKEN_CREDENTIAL_INVALID()
    {
        return self::ShowErrorMessage("CLI", "Client Error", 16, "Invalid token credential.");
    }


    public function INVALID_CONCEPT_CASTING()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 1, "Invalid concept conversion from '%s' to '%s'.");
    }

    public static function MISSING_TRANSACTION()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 2, "Transaction cannot be null.");
    }

    public static function MISSING_IID()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 3, "IID cannot be null or empty.");
    }

    public static function MISSING_LABEL()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 4, "Label cannot be null or empty.");
    }

    public static function BAD_ENCODING()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 5, "The encoding '%s' was not recognised.");
    }

    public static function BAD_VALUE_TYPE()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 6, "The value type '%s' was not recognised.");
    }

    public static function BAD_ATTRIBUTE_VALUE()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 7, "The attribute value '%s' was not recognised.");
    }

    public static function NONEXISTENT_EXPLAINABLE_CONCEPT()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 8, "The concept identified by '%s' is not explainable.");
    }

    public static function NONEXISTENT_EXPLAINABLE_OWNERSHIP()
    {
        return self::ShowErrorMessage("CON", "Concept Error", 9, "The ownership by owner '%s' of attribute '%s' is not explainable.");
    }

    public function VARIABLE_DOES_NOT_EXIST()
    {
        return self::ShowErrorMessage("QRY", "Query Error", 1, "The variable '%s' does not exist.");
    }

    public static function NO_EXPLANATION()
    {
        return self::ShowErrorMessage("QRY", "Query Error", 2, "No explanation was found.");
    }

    public static function BAD_ANSWER_TYPE()
    {
        return self::ShowErrorMessage("QRY", "Query Error", 3, "The answer type '%s' was not recognised.");
    }

    public static function MISSING_ANSWER()
    {
        return self::ShowErrorMessage("QRY", "Query Error", 4, "The required field 'answer' of type '%s' was not set.");
    }

    public function UNEXPECTED_INTERRUPTION()
    {
        return self::ShowErrorMessage("INT", "Internal Error", 1, "Unexpected thread interruption!");
    }

    public static function ILLEGAL_STATE()
    {
        return self::ShowErrorMessage("INT", "Internal Error", 2, "Illegal state has been reached!");
    }

    public static function ILLEGAL_ARGUMENT()
    {
        return self::ShowErrorMessage("INT", "Internal Error", 3, "Illegal argument provided: '%s'");
    }

    public static function ILLEGAL_CAST()
    {
        return self::ShowErrorMessage("INT", "Internal Error", 4, "Illegal casting operation to '%s'.");
    }

    public static function ILLEGAL_ARGUMENT_COMBINATION()
    {
        return self::ShowErrorMessage("INT", "Internal Error", 5, "Illegal argument combination provided: '%s'");
    }


}