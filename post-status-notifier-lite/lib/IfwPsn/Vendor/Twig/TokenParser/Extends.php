<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Extends a template by another one.
 *
 * <pre>
 *  {% extends "base.html" %}
 * </pre>
 *
 * @final
 */
class IfwPsn_Vendor_Twig_TokenParser_Extends extends IfwPsn_Vendor_Twig_TokenParser
{
    public function parse(IfwPsn_Vendor_Twig_Token $token)
    {
        $stream = $this->parser->getStream();

        if (!$this->parser->isMainScope()) {
            throw new IfwPsn_Vendor_Twig_Error_Syntax('Cannot extend from a block.', $token->getLine(), $stream->getSourceContext());
        }

        if (null !== $this->parser->getParent()) {
            throw new IfwPsn_Vendor_Twig_Error_Syntax('Multiple extends tags are forbidden.', $token->getLine(), $stream->getSourceContext());
        }
        $this->parser->setParent($this->parser->getExpressionParser()->parseExpression());

        $stream->expect(IfwPsn_Vendor_Twig_Token::BLOCK_END_TYPE);
    }

    public function getTag()
    {
        return 'extends';
    }
}

//class_alias('IfwPsn_Vendor_Twig_TokenParser_Extends', 'Twig\TokenParser\ExtendsTokenParser', false);
