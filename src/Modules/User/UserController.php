<?
namespace Modules\User;

use \Core\Presenter;
use \Core\ResponseCode;

/**
 * @property UserService $service
 */
class UserController extends \Core\Controller
{
    public function __construct()
    {
        $this->service = new UserService();
    }

    public function login()
    {
        try {
            Presenter::encerrar($this->service->login($_GET));
        } catch (\Throwable $e) {
            Presenter::handleException($e, ResponseCode::ERRO_LOGIN);
        }
    }
    
    public function logout()
    {
        try {
            Presenter::encerrar($this->service->logout());
        } catch (\Throwable $e) {
            Presenter::handleException($e);
        }
    }
}