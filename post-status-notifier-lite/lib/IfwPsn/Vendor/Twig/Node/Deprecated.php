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
 * Represents a deprecated node.
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class IfwPsn_Vendor_Twig_Node_Deprecated extends IfwPsn_Vendor_Twig_Node
{
    public function __construct(IfwPsn_Vendor_Twig_Node_Expression $expr, $lineno, $tag = null)
    {
        parent::__construct(['expr' => $expr], [], $lineno, $tag);
    }

    public function compile(IfwPsn_Vendor_Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);

        $expr = $this->getNode('expr');

        if ($expr instanceof IfwPsn_Vendor_Twig_Node_Expression_Constant) {
            $compiler->write('@trigger_error(')
                ->subcompile($expr);
        } else {
            $varName = $compiler->getVarName();
            $compiler->write(sprintf('$%s = ', $varName))
                ->subcompile($expr)
                ->raw(";\n")
                ->write(sprintf('@trigger_error($%s', $varName));
        }

        $compiler
            ->raw('.')
            ->string(sprintf(' ("%s" at line %d).', $this->getTemplateName(), $this->getTemplateLine()))
            ->raw(", E_USER_DEPRECATED);\n")
        ;
    }
}

//class_alias('IfwPsn_Vendor_Twig_Node_Deprecated', 'Twig\Node\DeprecatedNode', false);
