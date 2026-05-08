<?
namespace Core;

use PHPUnit\Framework\TestCase;
use Core\ErroInterno;
use Throwable;

abstract class TestInterno extends TestCase
{
    protected function assertErroInterno(Throwable $erro, $expectedCode): void
    {
        if ($erro instanceof ErroInterno) {
            $this->assertEquals($expectedCode, $erro->getInternalCode());
            return;
        }
        $this->fail("O sistema deveria ter lançado uma ErroInterno ".$expectedCode.".");
    }
}