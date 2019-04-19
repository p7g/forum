<?php
namespace lib\db;

use lib\config\KeyValueStore;

/**
 * Get or set the database configuration. If an array is passed as argument, it
 * will set the configuration to that array and return the previous config,
 * otherwise if no argument is passed, the current configuration is returned.
 *
 * @param \lib\config\KeyValueStore $options An optional key-value store to set
 * @return object The current key-value store
 */
function configuration(KeyValueStore $options = null): ?KeyValueStore {
    static $config = null;
    if ($options === null) {
        return $config;
    }
    $old_config = $config;
    $config = $options;
    return $old_config;
}

/**
 * Connect to the database. This function should not need to be called directly,
 * as a connection will be made lazily when needed.
 *
 * @return \PDO A database connection
 */
function connect(): \PDO {
    $config = configuration();
    $dsn = $config->get('dsn');
    $username = $config->get('username');
    $password = $config->get('password');
    return new \PDO($dsn, $username, $password, $config->all());
}

/**
 * Get the database connection. If there is an existing connection, it will be
 * returned, otherwise a new connection will be established.
 *
 * @return \PDO A database connection
 */
function get_connection(): \PDO {
    static $connection = null;

    if ($connection !== null) {
        return $connection;
    }

    $connection = connect(configuration());
    return $connection;
}

/**
 * Execute a callable within a transation. If a transaction is already active,
 * an Error is thrown. If the given callable throws an Error or Exception, the
 * transaction will be rolled back. If all goes well the transaction is
 * committed.
 *
 * @param callable $fn The function to execute within the transaction.
 * @param bool $suppress Suppress anything thrown by the given callable. By
 * default this value is false (Errors and Exceptions are rethrown)
 * @return mixed The return value of the given callable or null if failed
 */
function transact(callable $fn, bool $suppress = false) {
    $connection = get_connection();

    if ($connection->inTransaction()) {
        throw new \Error('Already in transaction');
    }

    $connection->beginTransaction();
    try {
        $result = $fn();
        $connection->commit();
        return $result;
    } catch (\Throwable $e) {
        $connection->rollBack();
        if (!$suppress) {
            throw $e;
        }
    }
}

/**
 * Query the database, expecting a single row.
 *
 * @param string $sql The query to execute.
 * @param array $params An array of values to replace the placeholders in the
 * query.
 * @return array The found row from the database.
 */
function query(string $sql, array $params = [],
               int $style = \PDO::FETCH_LAZY): array {
    $statement = get_connection()->prepare($sql);
    $statement->execute($params);
    return $statement->fetch(\PDO::FETCH_LAZY);
}

/**
 * Get a generator that will iterate through the results of the given query
 *
 * @param string $sql The SQL query to execute
 * @param array $params The parameters corresponding to those used in the query
 * @return iterable
 */
function query_all(string $sql, array $params = []): iterable {
    $statement = get_connection()->prepare($sql);
    $statement->execute($params);

    while ($value = $statement->fetch(\PDO::FETCH_LAZY)) {
        yield $value;
    }

    return $statement->rowCount();
}
