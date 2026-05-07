<?php

namespace Core;

// Responsabilidade: Estabelcer a conexão com o banco de dados.
class Database
{
    private $dbo = null;
    private $registrosAfetados;
    private $erroPdo = [];
    private $transaction;
    private $dboTransaction;

    public function getConexao()
    {
        try {
            $connection = new \PDO($_ENV['DRIVER'] . ":host=" . $_ENV['HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB'] . ";user=" . $_ENV['USER'] . ";password=" . $_ENV['PASSWORD']);
            return $connection;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), ResponseCode::ERRO_DE_CONEXAO);
        }
    }

    public function getDbo()
    {
        if (!empty($this->dbo)) {
            return $this->dbo;
        }
        if (!empty($_ENV)) {
            return $this->dbo = $this->getConexao();
        }
        throw new \Exception("Arquivo .env não definido", ResponseCode::FALHA_ENV);
    }
    public function beginTransaction()
    {
        if (empty($this->dboTransaction)) {
            $this->setDboTransaction($this->getConexao());
        }
        $this->getDboTransaction()->beginTransaction();
    }
    public function rollback()
    {
        $this->getDboTransaction()->rollBack();
    }
    public function commit()
    {
        $this->getDboTransaction()->commit();
    }
    public function endTransaction()
    {
        $erros = $this->getErroPdo();
        if (empty($erros)) {
            $this->commit();
        } else {
            $this->rollBack();
        }
        $this->dboTransaction = null;
        $this->resetErroPdo();
        return empty($erros) ? null : $erros;
    }
    public function getErroPdo()
    {
        if (empty($this->erroPdo)) {
            return '';
        }

        $lista = [];
        foreach ($this->erroPdo as $erro) {
            if ((is_array($erro)) || (is_object($erro))) {
                $lista[] = json_encode($erro);
            } else {
                $lista[] = $erro;
            }
        }
        return implode('<br>', $lista);
    }
    public function resetErroPdo()
    {
        $this->erroPdo = [];
    }
    public function setErroPdo($erroPdo)
    {
        if (is_array($erroPdo)) {
            $erroPdo = json_encode($erroPdo);
        }
        $this->erroPdo[] = $erroPdo;
    }
    public function getTransaction()
    {
        return $this->transaction;
    }
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
    }
    public function getDboTransaction()
    {
        if (!empty($this->dboTransaction)) {
            return $this->dboTransaction;
        } else {
            $this->beginTransaction();
            return $this->dboTransaction;
        }
    }
    public function setDboTransaction($dboTransaction)
    {
        $this->dboTransaction = $dboTransaction;
    }
    public function getRegistrosAfetados()
    {
        if (empty($this->registrosAfetados)) {
            return 0;
        }
        return $this->registrosAfetados;
    }
    public function setRegistrosAfetados($registrosAfetados)
    {
        $this->registrosAfetados = $registrosAfetados;
    }
}
