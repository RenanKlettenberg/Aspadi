<?
namespace Core;

class ResponseCode
{
    /* DECONHECIDO / NÃO DEFINIDO - 0 */
    const ERRO_DESCONHECIDO = 'E-0-000';
    const SUCCESS = 'S-0-001';
    const EMAIL_SUCCESS = 'S-0-002';

    /* DESENVOLVEDOR - 3 */
    const ERRO_SINTAXE = 'E-3-033';
    const ERRO_SQL = 'E-3-034';
    const METODO_HTTP_NAO_SUPORTADO = 'E-31-035';
    const METODO_INEXISTENTE = 'E-31-036';
    const CLASSE_INEXISTENTE = 'E-31-037';

    /* SERVIDOR - 1 */
    const ERRO_EMAIL = 'A-1-003';
    const FALHA_RELATORIO = 'A-1-003';
    const ERRO_GERAR_PDF = 'E-1-004';
    const ERRO_SALVAR_ARQUIVO = 'E-1-006';
    const FALHA_AO_BUSCAR_DADOS = 'E-11-007';
    const FALHA_AO_INSERIR = 'E-11-008';
    const FALHA_AO_ATUALIZAR = 'E-11-009';
    const FALHA_AO_DELETAR = 'E-11-010';
    const FALHA_ENV = 'E-12-011';
    const ERRO_DE_CONEXAO = 'E-1-012';

    /* CLIENTE - 2 */
    const MUITAS_TENTATIVAS = 'A-2-013';
    const LOGIN_INVALIDO = 'A-2-014';
    const LANCAMENTO_DUPLICADO = 'A-2-015';
    const DATA_PASSADA = 'A-21-016';
    const DATA_INVALIDA = 'A-21-032';
    const FORMATO_INVALIDO = 'A-21-017';
    const SENHA_FRACA = 'A-21-018';
    const INATIVAR_MESTRE = 'A-21-019';
    const ANIMAL_INDISPONIVEL = 'A-21-020';
    const ANIMAL_JA_ADOTADO = 'A-21-021';
    const LIMITE_FOTOS = 'A-21-023';
    const ADOTANTE_RESTRITO = 'A-21-024';
    const ARQUIVO_MUITO_GRANDE = 'A-21-026';
    const DADOS_FALTANDO = 'A-21-027';
    const VALOR_NEGATIVO = 'A-21-028';
    const CPF_INVALIDO = 'A-21-029';
    const EMAIL_INVALIDO = 'A-21-030';
    const DINHEIRO_INVALIDO = 'A-21-031';
}