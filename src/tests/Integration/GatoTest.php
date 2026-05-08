<?

use Core\ResponseCode;
use Core\TestInterno;
use Modules\Gato\GatoService;

class GatoTest extends TestInterno
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
            $this->assertEquals('preto', $resultado[0]->cor);
        } catch (Throwable $e) {
            $this->fail("Retornou uma exception: " . $e->getMessage());
        }
    }

    public function testGetByCorDeveFalhar()
    {
        try {
            //Arrange
            $service = new GatoService();

            //Act
            $resultado = $service->getByCor(['cor' => '']);
            
            $this->fail("Nenhum erro foi disparado!");
        } catch (Throwable $e) {
            $this->assertErroInterno($e, ResponseCode::DADOS_FALTANDO);
        }
    }
}