<?
namespace Core;

class ResponseCode
{
    /* Sumário de categorias:
        1XXX - SUCESSOS
        2XXX - 
    */
    const SUCCESS = 1;
    const ERRO_SINTAXE = 2;
    const CLASSE_INEXISTENTE = 3;
    const METODO_INEXISTENTE = 4;
    const DADOS_FALTANDO = 5;
    const VALOR_NEGATIVO = 6;
    const FALHA_AO_INSERIR = 7;
    const FALHA_AO_ATUALIZAR = 8;
    const FALHA_AO_DELETAR = 9;
    const METODO_HTTP_NAO_SUPORTADO = 10;
    const FALHA_ENV = 11;
    const ERRO_DE_CONEXAO = 12; 
    const ERRO_SQL = 13; 
    CONST ERRO_DESCONHECIDO = 14;
    CONST FALHA_AO_BUSCAR_DADOS = 15;
}