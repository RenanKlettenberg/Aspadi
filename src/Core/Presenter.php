<?
namespace Core;

//Responsabilidade: Apresentar os dados formatados.
class Presenter
{
    public static function sair($body, $codigo = ResponseCode::SUCCESS, $msg = null)
    {
        header('Content-Type: application/json;');
        return json_encode([
            'cod' => $codigo,
            'msg' => $msg ?? ResponseMessage::get($codigo),
            'body' => $body
        ]);
    }

    public static function encerrar($body, $codigo = ResponseCode::SUCCESS, $msg = null)
    {
        header('Content-Type: application/json;');
        exit(json_encode([
            'cod' => $codigo,
            'msg' => $msg ?? ResponseMessage::get($codigo),
            'body' => $body
        ]));
    }

    public static function handleException(\Throwable $e, $defaultCode = ResponseCode::ERRO_DESCONHECIDO)
    {
        $mensagem = ResponseMessage::get($e->getCode() ?? '');
        $mensagemExiste = $mensagem !== ResponseMessage::DEFAULT_MSG;

        if ($mensagemExiste) {
            self::encerrar($e->getMessage(), $e->getCode());
        } else {
            self::encerrar($e->getMessage(), $defaultCode);
        }
    }
}