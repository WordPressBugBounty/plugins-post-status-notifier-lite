<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Arnaud Le Blanc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

@trigger_error('The IfwPsn_Vendor_Twig_Function_Method class is deprecated since version 1.12 and will be removed in 2.0. Use IfwPsn_Vendor_Twig_SimpleFunction instead.', E_USER_DEPRECATED);

/**
 * Represents a method template function.
 *
 * Use IfwPsn_Vendor_Twig_SimpleFunction instead.
 *
 * @author Arnaud Le Blanc <arnaud.lb@gmail.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class IfwPsn_Vendor_Twig_Function_Method extends IfwPsn_Vendor_Twig_Function
{
    protected $extension;
    protected $method;

    public function __construct(IfwPsn_Vendor_Twig_ExtensionInterface $extension, $method, array $options = [])
    {
        $options['callable'] = [$extension, $method];

        parent::__construct($options);

        $this->extension = $extension;
        $this->method = $method;
    }

    public function compile()
    {
        return sprintf('$this->env->getExtension(\'%s\')->%s', get_class($this->extension), $this->method);
    }
}
