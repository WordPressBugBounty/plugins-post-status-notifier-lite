<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class IfwPsn_Vendor_Twig_Node_Expression_Binary_GreaterEqual extends IfwPsn_Vendor_Twig_Node_Expression_Binary
{
    public function operator(IfwPsn_Vendor_Twig_Compiler $compiler)
    {
        return $compiler->raw('>=');
    }
}

//class_alias('IfwPsn_Vendor_Twig_Node_Expression_Binary_GreaterEqual', 'Twig\Node\Expression\Binary\GreaterEqualBinary', false);
