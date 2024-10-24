<?php
/**
 * Rule model mapper
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Rule.php 3174969 2024-10-24 12:26:47Z worschtebrot $
 */ 
class Psn_Model_Mapper_Rule extends IfwPsn_Wp_Model_Mapper_Abstract
{
    protected static $_instance;

    /**
     * @return Psn_Model_Mapper_Rule
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return string
     */
    public function getSingular()
    {
        return 'rule';
    }

    /**
     * @return string
     */
    public function getPlural()
    {
        return 'rules';
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return 'Psn_Model_Rule';
    }
}
