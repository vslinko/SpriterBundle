<?php
/**
 * @copyright 2012 Rithis Studio LLC
 * @author Vyacheslav Slinko <vyacheslav.slinko@rithis.com>
 */

namespace Rithis\SpriterBundle\Twig;

use Twig_Node;
use Twig_Compiler;

class SpriterNode extends Twig_Node
{
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('echo $this->env->getExtension(\'rithis_spriter\')->spriteFunction(')
            ->subcompile($this->getNode('directory'));

        if ($this->hasNode('output')) {
            $compiler
                ->write(', ')
                ->subcompile($this->getNode('output'));
        }

        if ($this->hasNode('url')) {
            $compiler
                ->write(', ')
                ->subcompile($this->getNode('url'));
        }

        $compiler->write(");\n");
    }
}
