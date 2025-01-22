<?php

namespace Framework;

use PDO;
use Exception;
use PDOException;

class Database
{
    public $conn;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];
        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $th) {
            throw new Exception('Something Went Wrong :' . $th->getMessage());
        }
    }

    /**
     * Query
     *
     * @param string $query
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($query, $datas = [])
    {
        try {
            $stm = $this->conn->prepare($query);
            foreach ($datas as $param => $value) {
                $stm->bindValue($param, $value);
            }
            $stm->execute();
            return $stm;
        } catch (PDOException $th) {
            throw new Exception('error ' . $th->getMessage());
        }
    }
}
