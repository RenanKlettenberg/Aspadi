<?
namespace Core;

class Router
{
    /* (Todas as requisições seguem o formato '../Core/[classe]')
    Requisições podem ser feitas de algumas formas: 
    -GET (tudo) classe
    -GET (byId) classe/id
    -GET (custom) classe/metodo?param=valor&param2=valor2

    -POST (insert) classe
    -POST (update) classe/id
    -POST (custom) classe/metodo

    -DELETE (byId) classe/id
    -DELETE (custom) classe/metodo/id (demais dados enviados por $_GET na URL)
    */
    public static function carregar($request)
    {
        ob_start();
        self::capturadorDeErros();

        $params = explode('/', $request['url']);

        $nameSpace = '\\Modules\\' . ucfirst($params[0]);
        $classe = $nameSpace . '\\' . ucfirst($params[0]) . 'Controller';
        if (!class_exists($classe)) {
            Presenter::sair([], ResponseCode::CLASSE_INEXISTENTE);
        }
        $controller = new $classe();

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (count($params) == 1) {
                    return $controller->getAll();
                } else if (is_numeric($params[1])) {
                    return $controller->getById($params[1]);
                } else {
                    if (!method_exists($classe, $params[1])) {
                        Presenter::sair([], ResponseCode::METODO_INEXISTENTE);
                    }
                    return $controller->{$params[1]}();
                }
            case 'POST':
                if (count($params) == 1) {
                    return $controller->insert();
                } else if (is_numeric($params[1])) {
                    return $controller->update($params[1]);
                } else {
                    if (!method_exists($classe, $params[1])) {
                        Presenter::sair([], ResponseCode::METODO_INEXISTENTE);
                    }
                    return $controller->{$params[1]}();
                }
            case 'DELETE':
                if (is_numeric($params[1])) {
                    return $controller->delete($params[1]);
                } else {
                    if (!method_exists($classe, $params[1])) {
                        Presenter::sair([], ResponseCode::METODO_INEXISTENTE);
                    }
                    return $controller->$params[1]($params[2]);
                }
            default:
                Presenter::sair([], ResponseCode::METODO_HTTP_NAO_SUPORTADO);
        }
    }

    public static function capturadorDeErros()
    {
        set_error_handler(function ($nivel, $msg, $arquivo, $linha) {
            throw new \ErrorException($msg, 0, $nivel, $arquivo, $linha);
        });

        set_exception_handler(function ($e) {
            ob_clean();

            $body = [
                'msg' => $e->getMessage(),
                'arquivo' => $e->getFile(),
                'linha' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ];

            Presenter::sair($body, ResponseCode::ERRO_SINTAXE);
        });

        register_shutdown_function(function () {
            $erro = error_get_last();

            if ($erro && in_array($erro['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
                ob_clean();

                $body = [
                    'linha' => $erro['line'],
                    'arquivo' => basename($erro['file']),
                    'local_arquivo' => $erro['file'],
                    'msg' => $erro['message']
                ];

                Presenter::sair($body, ResponseCode::ERRO_SINTAXE);
            }
        });
    }

}