<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 * 
 * Abstract parser
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Abstract.php 3174969 2024-10-24 12:26:47Z worschtebrot $
 * @package  IfwPsn_Wp
 */
abstract class IfwPsn_Wp_Parser_Abstract implements IfwPsn_Wp_Parser_Interface
{
    /**
     * @var IfwPsn_Wp_Plugin_Logger
     */
    protected $_logger;
    
    /**
     * Set logger
     * @param IfwPsn_Wp_Plugin_Logger $logger
     */
    public function setLogger(IfwPsn_Wp_Plugin_Logger $logger)
    {
        $this->_logger = $logger;
    }
}
