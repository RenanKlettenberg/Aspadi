<?

use Core\ResponseCode;
use PHPUnit\Framework\TestCase;
use \Modules\Gato\GatoService;
use \Modules\Gato\GatoRepository;
class GatoTest extends TestCase
{
    public function testGetByCorDevePassar()
    {
        try {
            //Arrange
            $stub = $this->createStub(GatoRepository::class);
            $stub->method('getByCor')->willReturn([['gat_id' => 1]]);
            $service = new GatoService($stub);

            //Act
            $resultado = $service->getByCor(['cor' => 'preto']);

            //Assert
            $this->assertNotEmpty($resultado);
            $this->assertEquals(1, $resultado[0]['gat_id']);
        } catch (Throwable $e) {
            $this->fail("Retornou uma exception: " . $e->getMessage() . " | Código: " . $e->getCode());
        }
    }

    public function testGetByCorDeveFalhar()
    {
        //Arrange
        $stub = $this->createStub(GatoRepository::class);
        $stub->method('getByCor')->willReturn([['gat_id' => 1]]);
        $service = new GatoService($stub);

        //Assert
        $this->expectException(Throwable::class);
        $this->expectExceptionCode(ResponseCode::DADOS_FALTANDO);

        //Act
        $service->getByCor(['cor' => '']);
    }
}