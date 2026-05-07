<?
namespace Core;

//Responsabilidade: formar o SQL que será executado.
abstract class Repository
{
    protected Model $model;
    protected Conection $con;

    public function __construct($con = new Conection())
    {
        $this->con = $con;
    }

    public function getAll()
    {
        $sql = "SELECT " . implode(',', $this->model::CAMPOS) .
            " FROM " . $this->model::TABELA .
            " ORDER BY " . (defined(get_class($this->model) . '::ORDER_BY') ? ($this->model::ORDER_BY[0] . ' ' . $this->model::ORDER_BY[1]) : ($this->model::PK . 'DESC'));
        return $this->con->execute($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT " . implode(',', $this->model::CAMPOS) .
            " FROM " . $this->model::TABELA .
            " WHERE " . $this->model::PK . " = :" . $this->model::PK;
        return $this->con->execute($sql, [$this->model::PK => $id]);
    }

    public function insert($params)
    {
        $sql = "INSERT INTO " . $this->model::TABELA . "(" . implode(',', array_keys($params)) . ")" . " VALUES (:" . implode(',:', array_keys($params)) . ")";
        return $this->con->executeInsert($sql, $params);
    }

    public function update($params, $id)
    {
        $sets = array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($params));

        $sql = "UPDATE " . $this->model::TABELA . " SET " . implode(', ', $sets) . " WHERE " . $this->model::PK . " = :" . $this->model::PK;
        $params[$this->model::PK] = $id;
        return $this->con->executeUpdate($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->model::TABELA . " WHERE " . $this->model::PK . " = :" . $this->model::PK;
        return $this->con->executeDelete($sql, [$this->model::PK => $id]);
    }

    public function getModel()
    {
        return $this->model;
    }
}