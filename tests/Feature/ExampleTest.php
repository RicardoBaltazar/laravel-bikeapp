<?php

namespace Tests\Feature;

use App\TestExample;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCaixaContemItem()
    {
        $caixa = new TestExample(['carro', 'mochila', 'garfo']);

        $this->assertTrue($caixa->contem('mochila'));
        $this->assertFalse($caixa->contem('cubo magico'));
    }

    public function testCaixaContemUmItem()
    {
        $caixa = new TestExample(['lençol']);

        $this->assertEquals('lençol', $caixa->pegarUm());

        // Null, agora a caixa está vazia
        $this->assertNull($caixa->pegarUm());
    }

    public function testComecaComLetra()
    {
        $caixa = new TestExample(['cooler', 'mouse', 'fone', 'celular', 'computador']);

        $results = $caixa->comecaCom('c');

        $this->assertCount(3, $results);
        $this->assertContains('cooler', $results);
        $this->assertContains('celular', $results);
        $this->assertContains('computador', $results);

        // Vai devolver um array vazio
        $this->assertEmpty($caixa->comecaCom('s'));
    }
}

// exemple name methos check_if_user_column_is_correct - verbo - o que fazer- o que é experado
