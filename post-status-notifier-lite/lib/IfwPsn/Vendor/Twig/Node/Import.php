<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents an import node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class IfwPsn_Vendor_Twig_Node_Import extends IfwPsn_Vendor_Twig_Node
{
    public function __construct(IfwPsn_Vendor_Twig_Node_Expression $expr, IfwPsn_Vendor_Twig_Node_Expression $var, $lineno, $tag = null)
    {
        parent::__construct(['expr' => $expr, 'var' => $var], [], $lineno, $tag);
    }

    public function compile(IfwPsn_Vendor_Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('')
            ->subcompile($this->getNode('var'))
            ->raw(' = ')
        ;

        if ($this->getNode('expr') instanceof IfwPsn_Vendor_Twig_Node_Expression_Name && '_self' === $this->getNode('expr')->getAttribute('name')) {
            $compiler->raw('$this');
        } else {
            $compiler
                ->raw('$this->loadTemplate(')
                ->subcompile($this->getNode('expr'))
                ->raw(', ')
                ->repr($this->getTemplateName())
                ->raw(', ')
                ->repr($this->getTemplateLine())
                ->raw(')')
            ;
        }

        $compiler->raw(";\n");
    }
}

//class_alias('IfwPsn_Vendor_Twig_Node_Import', 'Twig\Node\ImportNode', false);
