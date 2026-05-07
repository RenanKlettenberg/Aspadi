<?
namespace Modules\Gato;

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
        if(\Core\Util::ehVazio($param)){
            throw new \Exception('Cor não informada', \Core\ResponseCode::DADOS_FALTANDO);
        }

        return $this->repository->getByCor(['cor' => $param['cor']]);;
    }
}