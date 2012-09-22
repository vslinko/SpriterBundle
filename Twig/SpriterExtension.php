<?php
/**
 * @copyright 2012 Rithis Studio LLC
 * @author Vyacheslav Slinko <vyacheslav.slinko@rithis.com>
 */

namespace Rithis\SpriterBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;
use Symfony\Component\HttpKernel\Kernel;
use Rithis\Spriter\Spriter;
use Rithis\Spriter\Formatter\CssFormatter;

class SpriterExtension extends Twig_Extension
{
    private $spriter;
    private $kernel;

    public function __construct(Spriter $spriter, Kernel $kernel)
    {
        $this->spriter = $spriter;
        $this->kernel = $kernel;
    }

    public function getFunctions()
    {
        return array(
            'sprite' => new Twig_Function_Method($this, 'spriteFunction', array('is_safe' => array('html'))),
        );
    }

    public function getTokenParsers()
    {
        return array(
            new SpriterTokenParser(),
        );
    }

    public function spriteFunction($directory, $output = '%kernel.root_dir%/../web/sprites', $url = '/sprites')
    {
        $name = crc32($directory);

        $directory = $this->kernel->locateResource($directory);
        $output = str_replace('%kernel.root_dir%', $this->kernel->getRootDir(), $output);

        if (!is_dir($output)) {
            mkdir($output, 0755, true);
        }

        $sprite = $this->spriter->scan($directory);

        $sprite->getImage()->save(sprintf('%s/%s.png', $output, $name));

        $formatter = new CssFormatter(sprintf('%s.png', $name));

        file_put_contents(sprintf('%s/%s.css', $output, $name), $formatter->format($sprite));

        return sprintf('<link rel="stylesheet" href="%s/%s.css">', rtrim($url, '/'), $name);
    }

    public function getName()
    {
        return 'rithis_spriter';
    }
}
