<?
namespace Core;

class ResponseMessage{
    const DEFAULT_MSG = 'Mensagem padrão não definida para esse código.';

    private static $message = [
        /* Mensages de X tipo */
        ResponseCode::SUCCESS => 'Operação realizada com sucesso!',
        ResponseCode::CLASSE_INEXISTENTE => 'A classe especificado não existe!',
        ResponseCode::METODO_INEXISTENTE => 'O método especificado não existe!',

        /* Mensages de Y tipo */
        ResponseCode::FALHA_AO_INSERIR => 'Parece que o sistema não conseguiu criar um novo registro!',
        ResponseCode::FALHA_AO_ATUALIZAR => 'Parece que o sistema não conseguiu atualizar o registro!',
        ResponseCode::FALHA_AO_DELETAR => 'Parece que o sistema não conseguiu deletar o registro!',
        ResponseCode::FALHA_AO_BUSCAR_DADOS => 'Parece que o sistema não conseguiu buscar o(s) registro(s)!',
        ResponseCode::DADOS_FALTANDO => 'Preencha todos os campos obrigatórios!',
        ResponseCode::VALOR_NEGATIVO => 'Valor negativo informado!',
        ResponseCode::METODO_HTTP_NAO_SUPORTADO => 'Método HTTP não suportado!',
        ResponseCode::FALHA_ENV => 'Arquivo de configuração (.env) não definido ou não encontrado!',
        ResponseCode::ERRO_DE_CONEXAO => 'Um erro ocorreu ao tentar estabelecer conexão com o banco de dados!',
        ResponseCode::ERRO_SQL => 'Um erro imprevisto ocorreu ao tentar passar instruções para o banco de dados!',
        ResponseCode::ERRO_SINTAXE => 'Erro de sintáxe ou compilação capturado!',

        ResponseCode::ERRO_DESCONHECIDO => self::DEFAULT_MSG
    ];

    public static function get($code){
        return self::$message[$code] ?? self::DEFAULT_MSG;
    }
}