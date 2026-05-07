<?
namespace Core;

abstract class Model{
    abstract function validarCampos($campos, $obrigatorios = false);
}