<?
namespace Modules\Email;

use Core\Util;
use Core\ErroInterno;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService extends \Core\Service
{
    public function __construct()
    {
    }

    public function enviarEmail($params)
    {
        $mail = new PHPMailer(true);

        $mail = self::configurarEmail($mail);
        $mail = self::addDestinatarios($mail, $params['destinatarios']);
        $mail = self::construirMensagem($mail, $params);

        $mail->send();
    }

    private static function configurarEmail($mail)
    {
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->SMTPSecure = '';
        // $mail->SMTPAuth = false;
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->Port = $_ENV['EMAIL_PORT'];

        return $mail;
    }

    private static function addDestinatarios($mail, $destinatarios)
    {
        $mail->setFrom($_ENV['EMAIL_USER'], 'Aspadi');

        foreach ($destinatarios as $destinatario) {
            $mail->addAddress($destinatario);
        }

        return $mail;
    }

    private static function construirMensagem($mail, $params)
    {
        $mail->isHTML(true);
        $mail->Subject = $params['assunto'] ?? 'Aspadi - E-mail automatizado';
        $mail->Body = self::carregarTemplate(($params['body'] ?? 'bodyPadrao'), $params);

        return $mail;
    }

    private static function carregarTemplate($templateNome, $dados = [])
    {
        $caminho = __DIR__ . "/templates/" . $templateNome . ".php";

        if (!file_exists($caminho)) {
            throw new \Exception("Template não encontrado: $templateNome");
        }

        extract($dados);

        ob_start();
        include $caminho;
        return ob_get_clean();
    }
}