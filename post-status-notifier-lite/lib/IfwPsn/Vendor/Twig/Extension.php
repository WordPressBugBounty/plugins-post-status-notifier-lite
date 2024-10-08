<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class IfwPsn_Vendor_Twig_Extension implements IfwPsn_Vendor_Twig_ExtensionInterface
{
    /**
     * @deprecated since 1.23 (to be removed in 2.0), implement IfwPsn_Vendor_Twig_Extension_InitRuntimeInterface instead
     */
    public function initRuntime(IfwPsn_Vendor_Twig_Environment $environment)
    {
    }

    public function getTokenParsers()
    {
        return [];
    }

    public function getNodeVisitors()
    {
        return [];
    }

    public function getFilters()
    {
        return [];
    }

    public function getTests()
    {
        return [];
    }

    public function getFunctions()
    {
        return [];
    }

    public function getOperators()
    {
        return [];
    }

    /**
     * @deprecated since 1.23 (to be removed in 2.0), implement IfwPsn_Vendor_Twig_Extension_GlobalsInterface instead
     */
    public function getGlobals()
    {
        return [];
    }

    /**
     * @deprecated since 1.26 (to be removed in 2.0), not used anymore internally
     */
    public function getName()
    {
        return get_class($this);
    }
}

//class_alias('IfwPsn_Vendor_Twig_Extension', 'Twig\Extension\AbstractExtension', false);
class_exists('IfwPsn_Vendor_Twig_Environment');
