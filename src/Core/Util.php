<?
namespace Core;

class Util
{
    public static function ehVazio($valores = null, $keys = false)
    {
        //Me passou os valores?
        if (($valores === null) || (!isset($valores)) || (is_array($valores) && count($valores) == 0)) {
            return true;
        }

        if (!is_array($valores)) {
            //Se veio só um valor, coloca ele numa array pra processar
            $valores = [$valores];
        } else if ($keys !== false) {
            //Tem menos valores do que valores obrigatórios?
            if (count($valores) < count($keys)) {
                return true;
            }
        }

        foreach ($valores as $valor) {
            //Valor tá vazio?
            if ((empty($valor)) && ($valor !== 0) && ($valor !== false)) {
                return true;
            }
        }

        if ($keys !== false) {
            //Tem todos os obrigatórios?
            foreach ($keys as $key) {
                if (!isset($valores[$key])) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isCpfValido($cpf = null)
    {
        if (($cpf === null) || (!isset($cpf))) {
            return false;
        }

        // 1. Remove qualquer caractere que não seja número
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // 2. Verifica se tem 11 dígitos ou se é uma sequência repetida conhecida
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // 3. Cálculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public static function isEmailValido($email = null)
    {        
        if (($email === null) || (!isset($email))) {
            return false;
        }

        // 1. Remove caracteres ilegais do e-mail
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // 2. Valida o formato do e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}