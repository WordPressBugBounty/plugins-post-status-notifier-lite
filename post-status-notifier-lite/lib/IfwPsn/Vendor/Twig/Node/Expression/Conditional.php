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
class IfwPsn_Vendor_Twig_Node_Expression_Conditional extends IfwPsn_Vendor_Twig_Node_Expression
{
    public function __construct(IfwPsn_Vendor_Twig_Node_Expression $expr1, IfwPsn_Vendor_Twig_Node_Expression $expr2, IfwPsn_Vendor_Twig_Node_Expression $expr3, $lineno)
    {
        parent::__construct(['expr1' => $expr1, 'expr2' => $expr2, 'expr3' => $expr3], [], $lineno);
    }

    public function compile(IfwPsn_Vendor_Twig_Compiler $compiler)
    {
        $compiler
            ->raw('((')
            ->subcompile($this->getNode('expr1'))
            ->raw(') ? (')
            ->subcompile($this->getNode('expr2'))
            ->raw(') : (')
            ->subcompile($this->getNode('expr3'))
            ->raw('))')
        ;
    }
}

//class_alias('IfwPsn_Vendor_Twig_Node_Expression_Conditional', 'Twig\Node\Expression\ConditionalExpression', false);
