<?
namespace Modules\Email;

use \Core\Presenter;
use \Core\ResponseCode;

/**
 * @property EmailService $service
 */
class EmailController extends \Core\Controller
{
    public function __construct()
    {
        $this->service = new EmailService();
    }

    public function enviarEmail()
    {
        try {
            Presenter::encerrar($this->service->enviarEmail($_POST), ResponseCode::EMAIL_SUCCESS);
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::ERRO_EMAIL);
        }
    }
}