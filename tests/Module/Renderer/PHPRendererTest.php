<?php
namespace Tests\Module\Renderer;

use PHPUnit\Framework\TestCase;
use Module\Renderer\PHPRenderer;

class PHPRendererTest extends TestCase
{

    /**
     * @var Renderer
     */
    private $renderer;

    public function setUp(): void
    {
        $this->renderer = new PHPRenderer();
        $this->renderer->addPath(__DIR__ . '/views');
    }

    public function testRenderMatchPath()
    {
        $this->renderer->addPath('blog', __DIR__ . '/views');
        $content = $this->renderer->render('@blog/views');
        $this->assertEquals("Salut les gens", $content);
    }

    public function testRenderDefaultPath()
    {
        $content = $this->renderer->render('demo');
        $this->assertEquals("Salut les gens", $content);
    }

    public function testRenderWithParams()
    {
        $content = $this->renderer->render('demoparams', ['nom' => 'Brandon']);
        $this->assertEquals("Bonjour Brandon.", $content);
    }
}