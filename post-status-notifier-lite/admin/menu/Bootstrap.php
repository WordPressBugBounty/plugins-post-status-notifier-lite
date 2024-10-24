<?php
/**
 * Admin menu bootstrap 
 *
 * @author   Timo Reith <timo@ifeelweb.de>
 * @version  $Id: Bootstrap.php 3174969 2024-10-24 12:26:47Z worschtebrot $
 */
require_once dirname(__FILE__) . '/controllers/PsnApplicationController.php';
require_once dirname(__FILE__) . '/controllers/PsnModelBindingController.php';

class Psn_Admin_Menu_Bootstrap extends IfwPsn_Zend_Application_Bootstrap_Bootstrap
{
    protected function _initResources(): void
    {
    }
}
