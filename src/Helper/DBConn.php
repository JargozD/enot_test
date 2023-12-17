<?php

namespace App\Helper;

class DBConn
{
    private $connection = null;

    public function __construct()
    {
        $this->connection = \pg_connect(
            "host=" . getenv('DB_HOST') . ' ' .
            "dbname=" . getenv('DB_DATABASE') . ' ' .
            "user=" . getenv('DB_USERNAME') . ' ' .
            "password=" . getenv('DB_PASSWORD')
        );

        if (!$this->connection) {
            throw new \Throwable('DB_connection error' . pg_last_error());
        }
    }

    public function __destruct()
    {
        if ($this->connection) {
            \pg_close($this->connection);
        }
    }

    public function execute(string $query, array $params = [])
    {
        $result = pg_query_params($this->connection, $query, $params);

        if (!$result) {
            throw new \Throwable("DB_query error $query " . pg_last_error());
        }

        return $result;
    }

    public function fetchOne(string $query, array $params = [])
    {
        $result = pg_fetch_assoc($this->execute($query, $params));
        return $result !== false ? $result : null;
    }

    public function fetchAll(string $query, array $params = [])
    {
        return pg_fetch_all($this->execute($query, $params));
    }
}
