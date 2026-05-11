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
}