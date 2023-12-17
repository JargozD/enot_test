<?php

namespace App\Repository;

use App\Helper\DBConn;

class BaseRepository
{
    protected const TABLE = null;

    protected const FIELDS = [];

    protected DBConn $connect;

    public function __construct()
    {
        $this->connect = new DBConn();
    }

    public function getById($id)
    {
        return $this->connect->fetchOne(
            "SELECT * FROM " . static::TABLE . " WHERE id = $1",
            [$id]
        );
    }

    public function getOne(array $data)
    {
        $data = array_intersect_key($data, array_flip(static::FIELDS));
        $i = 1;
        $conditions = [];
        foreach ($data as $key => $value) {
            $conditions[] = "$key = $$i";
            $i++;
        }

        $conditions = join(" AND ", $conditions);

        return $this->connect->fetchOne(
            "SELECT * FROM " . static::TABLE . " WHERE $conditions",
            $data
        );
    }

    public function getAllTable()
    {
        return $this->connect->fetchAll(
            "SELECT * FROM " . static::TABLE . " WHERE TRUE"
        );
    }

    public function add(array $data)
    {
        $data = array_intersect_key($data, array_flip(static::FIELDS));
        $keys = join(",", array_keys($data));
        $paramNumbers = "$". join(",$", range(1, count($data)));
        return $this->connect->execute(
            "INSERT INTO ". static::TABLE . " ($keys) VALUES ($paramNumbers)",
            $data
        );
    }

    public function clearTable()
    {
        return $this->connect->execute(
            "DELETE FROM ". static::TABLE . " WHERE TRUE"
        );
    }

}