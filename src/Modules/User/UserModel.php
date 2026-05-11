<?
namespace Modules\User;

class UserModel extends \Core\Model
{
    CONST TABELA = 'system.sys_usuario';
    CONST CAMPOS = ['usu_id', 'usu_nome', 'usu_email', 'usu_password'];
    CONST CAMPOS_NOT_NULL = ['usu_nome', 'usu_email', 'usu_password'];
    CONST PK = 'usu_id';

    function validarCampos($campos, $obrigatorios = false)
    {
        if (\Core\Util::ehVazio($campos, $obrigatorios === false ? self::CAMPOS_NOT_NULL : $obrigatorios)) {
            return \Core\ResponseCode::DADOS_FALTANDO;
        }
        if ((isset($campos['idade'])) && ($campos['idade'] <= 0)) {
            return \Core\ResponseCode::VALOR_NEGATIVO;
        }
        return true;
    }
}