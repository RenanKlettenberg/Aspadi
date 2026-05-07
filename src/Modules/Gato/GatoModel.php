<?
namespace Modules\Gato;

class GatoModel extends \Core\Model
{
    CONST TABELA = 'animais.gato';
    CONST CAMPOS = ['gat_id', 'nome', 'idade', 'cor'];
    CONST CAMPOS_NOT_NULL = ['nome', 'idade', 'cor'];
    CONST PK = 'gat_id';
    CONST ORDER_BY = ['gat_id','ASC']; 

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