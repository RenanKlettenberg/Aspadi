<?

use Core\ResponseCode;
use PHPUnit\Framework\TestCase;
use Modules\Gato\GatoService;

class GatoTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
    }

    public function testGetByCorDevePassar()
    {
        try {
            //Arrange
            $service = new GatoService();

            //Act
            $resultado = $service->getByCor(['cor' => 'preto']);

            //Assert
            $this->assertNotEmpty($resultado);
            $this->assertEquals('preto', $resultado[0]->cor);
        } catch (Throwable $e) {
            $this->fail("Retornou uma exception: " . $e->getMessage() . " | Código: " . $e->getCode());
        }
    }

    public function testGetByCorDeveFalhar()
    {
        //Arrange
        $service = new GatoService();

        //Assert
        $this->expectException(Throwable::class);
        $this->expectExceptionCode(ResponseCode::FALHA_AO_BUSCAR_DADOS);

        //Act
        $service->getByCor(['cor' => '']);
    }
}