<?
namespace Modules\User;

use Core\ResponseCode;
use Core\Util;
use Core\ErroInterno;

/**
 * @property UserRepository $repository
 */
class UserService extends \Core\Service
{
    public function __construct(\Core\Repository $repository = new UserRepository())
    {
        $this->repository = $repository;
    }

    public function login($params)
    {
        if (Util::ehVazio($params, ['usu_email', 'usu_password'])) {
            throw new ErroInterno('Dados faltando', ResponseCode::DADOS_FALTANDO);
        }

        $user = self::getByEmail(['usu_email' => $params['usu_email']]);
        if (count($user) == 0) {
            throw new ErroInterno('Login/Senha inválidos', ResponseCode::LOGIN_INVALIDO);
        }
        $user = $user[0];

        $senha = hash_hmac("sha256", $params['usu_password'], $_ENV['SECRET']);
        if (!hash_equals($user->usu_password, $senha)) {
            throw new ErroInterno('Login/Senha inválidos', ResponseCode::LOGIN_INVALIDO);
        }

        $_SESSION['usuario'] = $user;

        return;
    }

    public function getByEmail($params)
    {
        if (Util::ehVazio($params, ['usu_email'])) {
            throw new ErroInterno('Dados faltando', ResponseCode::DADOS_FALTANDO);
        }

        return $this->repository->getByEmail($params);
    }

    public function insert($params)
    {
        $model = $this->repository->getModel();
        $validacao = $model->validarCampos($params);
        if ($validacao !== true) {
            throw new ErroInterno("Os campos não passaram na validação da model.", $validacao);
        }

        $params['usu_password'] = hash_hmac("sha256", $params['usu_password'], $_ENV['SECRET']);

        $id = $this->repository->insert($params);
        if (empty($id)) {
            throw new ErroInterno("O ID do registro não foi retornado.", ResponseCode::FALHA_AO_INSERIR);
        }

        return $id;
    }

    public function logout(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"]
            );
        }

        return session_destroy();
    }
}