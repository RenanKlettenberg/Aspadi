<?

use Core\ResponseCode;
use Core\TestInterno;
use \Modules\Gato\GatoService;
use \Modules\Gato\GatoRepository;
class GatoTest extends TestInterno
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
        try {
            //Arrange
            $stub = $this->createStub(GatoRepository::class);
            $stub->method('getByCor')->willReturn([['gat_id' => 1]]);
            $service = new GatoService($stub);

            //Act
            $service->getByCor(['cor' => '']);
        } catch (Throwable $e) {
            $this->assertErroInterno($e, ResponseCode::DADOS_FALTANDO);
        }
    }
}