<?
namespace Core;

class ResponseCode
{
    /* DECONHECIDO / NÃO DEFINIDO - 0 */
    const SUCCESS = 'S-0-001';
    const EMAIL_SUCCESS = 'S-0-002';

    /* DESENVOLVEDOR - 3 */
    const ERRO_SINTAXE = 'E-3-011';
    const METODO_INEXISTENTE = 'E-31-012';
    const CLASSE_INEXISTENTE = 'E-31-013';
    const METODO_HTTP_NAO_SUPORTADO = 'E-31-013';
    
    /* CLIENTE - 2 */
    const DADOS_FALTANDO = 'A-2-006';
    const VALOR_NEGATIVO = 'A-21-007';

    /* SERVIDOR - 1 */
    const FALHA_AO_INSERIR = 'E-11-002';
    const FALHA_AO_ATUALIZAR = 'E-11-003';
    const FALHA_AO_DELETAR = 'E-11-004';
    const FALHA_AO_BUSCAR_DADOS = 'E-11-005';
    const FALHA_ENV = 'E-12-023';
    const ERRO_DE_CONEXAO = 12;
    const ERRO_SQL = 13;
    const ERRO_DESCONHECIDO = 14;
}