<?
namespace Modules\Gato;

/**
 * @property GatoService $service
 */
class GatoController extends \Core\Controller
{
    public function __construct()
    {
        $this->service = new GatoService();
    }

    public function getByCor()
    {
        try {
            unset($_GET['url']);
            \Core\Presenter::encerrar($this->service->getByCor($_GET));
        } catch (\Throwable $e) {
            \Core\Presenter::handleException($e, \Core\ResponseCode::FALHA_AO_BUSCAR_DADOS);
        }
    }
}