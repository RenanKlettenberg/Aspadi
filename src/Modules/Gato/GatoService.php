<?
namespace Modules\Gato;

use Core\Util;
use Core\ErroInterno;

/**
 * @property GatoRepository $repository
 */
class GatoService extends \Core\Service
{
    public function __construct(\Core\Repository $repository = new GatoRepository())
    {
        $this->repository = $repository;
    }

    public function getByCor($param)
    {
        if(Util::ehVazio($param)){
            throw new ErroInterno('Cor não informada', \Core\ResponseCode::DADOS_FALTANDO);
        }

        return $this->repository->getByCor(['cor' => $param['cor']]);;
    }
}