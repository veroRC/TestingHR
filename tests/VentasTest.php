<?php 
declare(strict_types=1);
if (DIRECTORY_SEPARATOR === '/') {
    include_once(__DIR__ ."/../src/Ventas.php");
} else if (DIRECTORY_SEPARATOR === '\\') {
    include_once(__DIR__ ."\..\src\Ventas.php");
}

use PHPUnit\Framework\TestCase;

final class VentasTest extends TestCase
{
    public function testRegistrarVentasRetornaObjetoRespuesta(): void
    {
        $ventas = new Ventas();
        $respuesta = $ventas->registrarVenta(null);
        $this->assertInstanceOf(
            Respuesta::class, $respuesta
        );
    }
    
    public function testRegistrarVentaSinParametrosRetornaError(): void
    {
        $ventas = new Ventas();
        $respuesta = $ventas->registrarVenta(null);
        $this->assertEquals(
            true,
            $respuesta->isError()
        );
    }

    public function testRegistrarVentaConParametrosNoRetornaError(): void
    {
        $ventas = new Ventas();
        $params = 'parametros';
        $respuesta = $ventas->registrarVenta($params);
        $this->assertEquals(
            false,
            $respuesta->isError()
        );
    }
}
?>