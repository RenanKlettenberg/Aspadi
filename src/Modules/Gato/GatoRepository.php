<?
namespace Modules\Gato;

class GatoRepository extends \Core\Repository
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new GatoModel();
    }

    public function getByCor($params)
    {
        $sql = 'SELECT ' . (implode(',', $this->model::CAMPOS)) . ' FROM ' . $this->model::TABELA . ' WHERE cor = :cor';
        return $this->con->execute($sql, $params);
    }
}