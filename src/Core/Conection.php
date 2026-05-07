<?php

namespace Core;

//Responsabilidade: Conversar com o banco (enviar/receber mensagens).
class Conection
{
    private Database $db;

    public function __construct($database = new Database())
    {
        $this->db = $database;
    }

    function execute($sql, $parametros = false)
    {
        $retorno = [];
        try {
            $statement = $this->db->getDbo()->prepare($sql);
            $result = ((!empty($parametros)) ? $statement->execute($parametros) : $statement->execute());

            if ($result === false) {
                $this->db->setErroPdo($this->db->getDbo()->errorInfo());
            } else if ($statement->rowCount() > 0) {
                while ($row = $statement->fetchObject()) {
                    $retorno[] = $row;
                }
            }
            return $retorno;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), ResponseCode::ERRO_SQL);
        }
    }
    function executeDelete($sql, $parametros)
    {
        $retorno = 0;
        try {
            $statement = $this->db->getDbo()->prepare($sql);
            $result = $statement->execute($parametros);

            if ($result === false) {
                $this->db->setErroPdo($this->db->getDbo()->errorInfo());
            } else {
                $retorno = $statement->rowCount();
            }
            return $retorno;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), ResponseCode::ERRO_SQL);
        }
    }
    function executeUpdate($sql, $parametros = false)
    {
        return $this->executeDelete($sql, $parametros);
    }
    function executeInsert($sql, $parametros = false)
    {
        $retorno = null;
        try {
            $query = $this->db->getDbo()->prepare($sql);
            $result = $query->execute((empty($parametros) ? null : $parametros));

            if ($result === false) {
                $this->db->setErroPdo($this->db->getDbo()->errorInfo());
            } else {
                $retorno = $this->db->getDbo()->lastInsertId() ?? null;
            }
            return $retorno;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), ResponseCode::ERRO_SQL);
        }
    }
    public function executeTransaction($sql, $parametros = false)
    {
        $retorno = false;
        try {
            $query = $this->db->getDboTransaction()->prepare($sql);
            $result = ((!empty($parametros)) ? $query->execute($parametros) : $query->execute());

            if ($result === false) {
                $this->db->setErroPdo($sql);
                if (!empty($parametros)) {
                    $this->db->setErroPdo($parametros);
                }
                $this->db->setErroPdo($this->db->getDboTransaction()->errorInfo());
            } else {
                $retorno = $query->rowCount();
                $this->db->setRegistrosAfetados($retorno);
            }
            return $retorno;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), ResponseCode::ERRO_SQL);
        }
    }
}