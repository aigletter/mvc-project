<?php


namespace Core\Services\Database;


class Db
{
    protected $pdo;

    public function __construct($dsn, $user, $password)
    {
        // mysql:dbname=testdb;host=127.0.0.1
        $this->pdo = new \PDO($dsn, $user, $password);
    }

    public function query($query)
    {
        //$sql = $query->toSql();
        $result = $this->pdo->query($query);

        return $result->fetchAll();
    }

    public function rawOne(string $sql, $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}