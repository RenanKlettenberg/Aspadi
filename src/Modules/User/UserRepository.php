<?
namespace Modules\User;

class UserRepository extends \Core\Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    public function getByEmail($params)
    {
        $sql = 'SELECT ' . (implode(',', $this->model::CAMPOS)) . ' FROM ' . $this->model::TABELA . ' WHERE usu_email = :usu_email';
        return $this->con->execute($sql, $params);
    }

    public function getCodigoAuthByEmail($params)
    {
        $sql = 'SELECT usu_id, usu_codigo_auth, usu_codigo_auth_validade FROM ' . $this->model::TABELA . ' WHERE usu_email = :usu_email';
        return $this->con->execute($sql, $params);
    }

    public function getPasswordByEmail($params)
    {
        $sql = 'SELECT usu_id, usu_password FROM ' . $this->model::TABELA . ' WHERE usu_email = :usu_email';
        return $this->con->execute($sql, $params);
    }

    public function updateCodigoAutorizacao($params)
    {
        $sql = 'UPDATE ' . $this->model::TABELA . ' SET usu_codigo_auth = :usu_codigo_auth, usu_codigo_auth_validade = :usu_codigo_auth_validade WHERE usu_id = :usu_id';
        return $this->con->executeUpdate($sql, $params);
    }
}