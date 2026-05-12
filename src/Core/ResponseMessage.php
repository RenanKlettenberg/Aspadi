<?
namespace Core;

class ResponseMessage
{
    const DEFAULT_MSG = 'Mensagem padrão não definida para esse código.';

    private static $message = [
            /* DECONHECIDO / NÃO DEFINIDO - 0 */
        ResponseCode::ERRO_DESCONHECIDO => self::DEFAULT_MSG,
        ResponseCode::SUCCESS => 'Operação realizada com sucesso!',
        ResponseCode::EMAIL_SUCCESS => 'E-mail enviado com sucesso!',

            /* DESENVOLVEDOR - 3 */
        ResponseCode::CLASSE_INEXISTENTE => 'A classe especificado não existe!',
        ResponseCode::METODO_INEXISTENTE => 'O método especificado não existe!',
        ResponseCode::ERRO_SINTAXE => 'Erro de sintáxe ou compilação capturado!',
        ResponseCode::ERRO_SQL => 'Um erro imprevisto ocorreu ao tentar passar instruções SQL para o banco de dados!',
        ResponseCode::METODO_HTTP_NAO_SUPORTADO => 'Método HTTP não suportado!',
        ResponseCode::ROTA_NAO_INFORMADA => 'Nenhuma rota foi informada!',

            /* SERVIDOR - 1 */
        ResponseCode::FALHA_ENV => 'Arquivo de configuração (.env) não definido ou não encontrado!',
        ResponseCode::ERRO_DE_CONEXAO => 'Um erro ocorreu ao tentar estabelecer conexão com o banco de dados.',
        ResponseCode::FALHA_RELATORIO => 'O sistema falhou em gerar o relatório.',
        ResponseCode::ERRO_EMAIL => 'O sistema falhou em enviar o e-mail.',
        ResponseCode::ERRO_GERAR_PDF => 'O sistema falhou em gerar o PDF.',
        ResponseCode::ERRO_LOGIN => 'Erro ao fazer login!',
        ResponseCode::ERRO_SALVAR_ARQUIVO => 'O sistema falhou em salvar o arquivo.',
        ResponseCode::FALHA_AO_INSERIR => 'Parece que o sistema não conseguiu criar um novo registro!',
        ResponseCode::FALHA_AO_ATUALIZAR => 'Parece que o sistema não conseguiu atualizar o registro!',
        ResponseCode::FALHA_AO_DELETAR => 'Parece que o sistema não conseguiu deletar o registro!',
        ResponseCode::FALHA_AO_BUSCAR_DADOS => 'Parece que o sistema não conseguiu buscar o(s) registro(s)!',

            /* CLIENTE - 2 */
        ResponseCode::MUITAS_TENTATIVAS => 'Conta bloqueada temporariamente! Muitas tentativas de login.',
        ResponseCode::LOGIN_INVALIDO => 'E-mail ou senha inválido!',
        ResponseCode::LANCAMENTO_DUPLICADO => 'Possível lançamento duplicado detectado. Deseja continuar mesmo assim?',
        ResponseCode::DATA_INVALIDA=> 'Insira uma data válida!',
        ResponseCode::DATA_PASSADA => 'Insira uma data maior ou igual a atual!',
        ResponseCode::FORMATO_INVALIDO => 'Formato de arquivo inválido.',
        ResponseCode::SENHA_FRACA => 'Senha muito fraca.',
        ResponseCode::INATIVAR_MESTRE => 'Não é possível inativar o usuário mestre!',
        ResponseCode::ANIMAL_INDISPONIVEL => 'O animal selecionado não está disponível para adoção.',
        ResponseCode::ANIMAL_JA_ADOTADO => 'O animal selecionado já possui um adotante ativo.',
        ResponseCode::LIMITE_FOTOS=> 'Limite de fotos atingido. Exclua uma imagem antes de enviar outra.',
        ResponseCode::ADOTANTE_RESTRITO=> 'Adotante com restrição ativa. Não é possível realizar a vinculação.',
        ResponseCode::ARQUIVO_MUITO_GRANDE=> 'O arquivo excede o tamanho máximo permitido.',
        ResponseCode::DADOS_FALTANDO=> 'Preencha todos os campos obrigatórios.',
        ResponseCode::VALOR_NEGATIVO=> 'Insira um valor positivo!',
        ResponseCode::CPF_INVALIDO=> 'Insira um CPF válido!',
        ResponseCode::EMAIL_INVALIDO=> 'Insira um e-mail válido!',
        ResponseCode::DINHEIRO_INVALIDO=> 'Insira um valor válido!',
    ];

    public static function get($code)
    {
        return self::$message[$code] ?? self::DEFAULT_MSG;
    }
}