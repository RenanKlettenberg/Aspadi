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

    public static function handleException($e, $defaultCode = ResponseCode::ERRO_DESCONHECIDO)
    {
        $isErroInterno = $e instanceof ErroInterno;

        if ($isErroInterno) {
            self::encerrar($e->getMessage(), $e->getInternalCode());
        } else {
            self::encerrar($e->getMessage(), $defaultCode);
        }
    }
}