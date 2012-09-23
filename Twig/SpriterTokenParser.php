<?php
/**
 * @copyright 2012 Rithis Studio LLC
 * @author Vyacheslav Slinko <vyacheslav.slinko@rithis.com>
 */

namespace Rithis\SpriterBundle\Twig;

use Twig_TokenParser;
use Twig_Token;

class SpriterTokenParser extends Twig_TokenParser
{
    public function parse(Twig_Token $token)
    {
        $nodes = array();

        $nodes['directory'] = $this->parser->getExpressionParser()->parseExpression();

        if ($this->parser->getStream()->test(Twig_Token::NAME_TYPE, 'with')) {
            $this->parser->getStream()->next();

            if ($this->parser->getStream()->test(Twig_Token::NAME_TYPE, 'prefix')) {
                $this->parser->getStream()->next();
                $nodes['prefix'] = $this->parser->getExpressionParser()->parseExpression();
            }

            if ($this->parser->getStream()->test(Twig_Token::NAME_TYPE, 'output-path')) {
                $this->parser->getStream()->next();
                $nodes['output'] = $this->parser->getExpressionParser()->parseExpression();
            }

            if ($this->parser->getStream()->test(Twig_Token::NAME_TYPE, 'url')) {
                $this->parser->getStream()->next();
                $nodes['url'] = $this->parser->getExpressionParser()->parseExpression();
            }
        }

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new SpriterNode($nodes, array(), $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'sprite';
    }
}
