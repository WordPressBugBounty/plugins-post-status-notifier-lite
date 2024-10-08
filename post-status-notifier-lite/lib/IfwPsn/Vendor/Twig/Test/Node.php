<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

@trigger_error('The IfwPsn_Vendor_Twig_Test_Node class is deprecated since version 1.12 and will be removed in 2.0.', E_USER_DEPRECATED);

/**
 * Represents a template test as a Node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class IfwPsn_Vendor_Twig_Test_Node extends IfwPsn_Vendor_Twig_Test
{
    protected $class;

    public function __construct($class, array $options = [])
    {
        parent::__construct($options);

        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function compile()
    {
    }
}
