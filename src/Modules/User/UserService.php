<?
namespace Modules\User;

use Core\ResponseCode;
use Core\Util;
use Core\ErroInterno;

use Modules\Email\EmailService;
use DateTime;

/**
 * @property UserRepository $repository
 */
class UserService extends \Core\Service
{
    private EmailService $emailService;

    public function __construct(\Core\Repository $repository = new UserRepository(), EmailService $emailService = new EmailService())
    {
        $this->repository = $repository;
        $this->emailService = $emailService;
    }

    public function login($params)
    {
        if (Util::ehVazio($params, ['usu_email', 'usu_password'])) {
            throw new ErroInterno('Dados faltando', ResponseCode::DADOS_FALTANDO);
        }

        $user = $this->repository->getPasswordByEmail(['usu_email' => $params['usu_email']]);
        if (count($user) == 0) {
            throw new ErroInterno('Login/Senha inválidos', ResponseCode::LOGIN_INVALIDO);
        }
        $user = $user[0];

        $senha = hash_hmac("sha256", $params['usu_password'], $_ENV['SECRET']);
        if (!hash_equals($user->usu_password, $senha)) {
            throw new ErroInterno('Login/Senha inválidos', ResponseCode::LOGIN_INVALIDO);
        }

        $_SESSION['usuario'] = $user;
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

    public function solicitarAlterarSenha($params)
    {
        if (Util::ehVazio($params, ['usu_email', 'usu_password', 'usu_password_confirm'])) {
            throw new ErroInterno('Dados faltando', ResponseCode::DADOS_FALTANDO);
        }

        $user = self::getByEmail(['usu_email' => $params['usu_email']]);
        if (count($user) == 0) {
            throw new ErroInterno('E-mail não pertence a nenhum usuário!', ResponseCode::USUARIO_NAO_ENCONTRADO);
        }
        $user = $user[0];

        if ($params['usu_password'] !== $params['usu_password_confirm']) {
            throw new ErroInterno('Senhas diferentes!', ResponseCode::SENHAS_NAO_CONFEREM);
        }

        $codidoAutorizacao = random_int(100000, 999999);
        $validade = (new DateTime('+1 day'))->format('Y-m-d H:i:s');
        $this->repository->updateCodigoAutorizacao(['usu_codigo_auth' => $codidoAutorizacao, 'usu_codigo_auth_validade' => $validade, 'usu_id' => $user->usu_id]);

        $email = [
            'destinatarios' => [$params['usu_email']],
            'assunto' => 'ASPADI - Redefinição de senha',
            'body' => 'recuperarSenha',
            'params' => [
                'usu_codigo_auth' => $codidoAutorizacao
            ]
        ];
        $this->emailService->enviarEmail($email);
    }

    public function alterarSenha($params)
    {
        if (Util::ehVazio($params, ['usu_email', 'usu_password', 'usu_codigo_auth'])) {
            throw new ErroInterno('Dados faltando', ResponseCode::DADOS_FALTANDO);
        }

        $user = $this->repository->getCodigoAuthByEmail(['usu_email' => $params['usu_email']]);
        if (count($user) == 0) {
            throw new ErroInterno('E-mail não pertence a nenhum usuário!', ResponseCode::USUARIO_NAO_ENCONTRADO);
        }
        $user = $user[0];

        $dataAtual = new DateTime();
        $dataValidade = new DateTime($user->usu_codigo_auth_validade);
        if (($user->usu_codigo_auth != $params['usu_codigo_auth']) || $dataAtual > $dataValidade) {
            throw new ErroInterno('Código errado ou expirado.', ResponseCode::CODIGO_AUTH_INVALIDO);
        }

        $params['usu_password'] = hash_hmac("sha256", $params['usu_password'], $_ENV['SECRET']);

        $afetados = $this->repository->update(['usu_password' => $params['usu_password'], 'usu_codigo_auth' => null], $user->usu_id);
        if (empty($afetados)) {
            throw new ErroInterno("Nenhum registro foi alterado com o SQL.", ResponseCode::FALHA_AO_ATUALIZAR);
        }

        return $afetados;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        return session_destroy();
    }
}