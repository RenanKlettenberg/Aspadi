<?
namespace Modules\Email;

use Core\Util;
use Core\ErroInterno;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService extends \Core\Service
{
    public function enviarEmail($params)
    {
        $mail = new PHPMailer(true);

        $mail = self::configurarEmail($mail);
        $mail = self::addDestinatarios($mail, $params['destinatarios']);
        $mail = self::construirMensagem($mail, $params);

        $mail->send();
    }

    public static function configurarEmail($mail)
    {
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->SMTPSecure = '';
        // $mail->SMTPAuth = false;
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->Port = $_ENV['EMAIL_PORT'];

        return $mail;
    }

    public static function addDestinatarios($mail, $destinatarios)
    {
        $mail->setFrom($_ENV['EMAIL_USER'], 'Aspadi');

        foreach ($destinatarios as $destinatario) {
            $mail->addAddress($destinatario);
        }

        return $mail;
    }

    public static function construirMensagem($mail, $params)
    {
        $mail->isHTML(true);
        $mail->Subject = $params['assunto'] ?? 'Aspadi - E-mail automatizado';
        $mail->Body = $params['body'] ?? 'Se vc recebeu isso é pq o Renan conseguiu fazer o envio de e-mail a partir do protótipo inicial da Aspadi. Responda ele caso vc recebeu <3';

        return $mail;
    }
}