<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

@trigger_error('The IfwPsn_Vendor_Twig_Node_Expression_ExtensionReference class is deprecated since version 1.23 and will be removed in 2.0.', E_USER_DEPRECATED);

/**
 * Represents an extension call node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.23 and will be removed in 2.0.
 */
class IfwPsn_Vendor_Twig_Node_Expression_ExtensionReference extends IfwPsn_Vendor_Twig_Node_Expression
{
    public function __construct($name, $lineno, $tag = null)
    {
        parent::__construct([], ['name' => $name], $lineno, $tag);
    }

    public function compile(IfwPsn_Vendor_Twig_Compiler $compiler)
    {
        $compiler->raw(sprintf("\$this->env->getExtension('%s')", $this->getAttribute('name')));
    }
}
