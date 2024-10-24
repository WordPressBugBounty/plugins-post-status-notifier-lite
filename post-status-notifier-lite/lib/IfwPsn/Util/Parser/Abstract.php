<?php
/**
 * ifeelweb.de WordPress Plugin Framework
 * For more information see http://www.ifeelweb.de/wp-plugin-framework
 *
 * @author    Timo Reith <timo@ifeelweb.de>
 * @version   $Id: Abstract.php 3174969 2024-10-24 12:26:47Z worschtebrot $
 * @package
 */
abstract class IfwPsn_Util_Parser_Abstract
{
    /**
     * @param $string
     * @return mixed
     */
    public static function stripNullByte($string)
    {
        if (!empty($string)) {
            $string = str_replace(chr(0), '', $string);
        }

        return $string;
    }
}
