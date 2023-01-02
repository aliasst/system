<?php

namespace core;


class Db
{
    use Tsingleton;
    private $pdo;

    private function __construct() {
        $dbOptions = (require_once CONFIG . '/config_db.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']);
        $this->pdo->exec('SET NAMES UTF8');
        if (DEBUG) {

        }

    }

    public function query(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete(string $sql, $params = []): ?bool
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        $count = $sth->rowCount();
        logger($count);
        if($count){
            return true;
        }
        return false;
    }

    public function save(string $sql, $params = []): ?bool
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        $count = $sth->rowCount();
        logger($count);
        if($count){
            return true;
        }
        return false;
    }


    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }


}