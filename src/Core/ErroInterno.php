<?
namespace Core;

class ErroInterno extends \Exception {
    protected $internalCode;

    public function __construct($message, $internalCode = ResponseCode::ERRO_DESCONHECIDO, $code = 0, \Throwable $previous = null) {
        $this->internalCode = $internalCode;
        parent::__construct($message, $code, $previous);
    }

    public function getInternalCode() {
        return $this->internalCode;
    }
}