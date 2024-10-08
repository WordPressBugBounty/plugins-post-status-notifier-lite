<?php

if (!defined('ENT_SUBSTITUTE')) {
    define('ENT_SUBSTITUTE', 8);
}

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @final
 */
class IfwPsn_Vendor_Twig_Extension_Core extends IfwPsn_Vendor_Twig_Extension
{
    protected $dateFormats = ['F j, Y H:i', '%d days'];
    protected $numberFormat = [0, '.', ','];
    protected $timezone = null;
    protected $escapers = [];

    /**
     * Defines a new escaper to be used via the escape filter.
     *
     * @param string   $strategy The strategy name that should be used as a strategy in the escape call
     * @param callable $callable A valid PHP callable
     */
    public function setEscaper($strategy, $callable)
    {
        $this->escapers[$strategy] = $callable;
    }

    /**
     * Gets all defined escapers.
     *
     * @return array An array of escapers
     */
    public function getEscapers()
    {
        return $this->escapers;
    }

    /**
     * Sets the default format to be used by the date filter.
     *
     * @param string $format             The default date format string
     * @param string $dateIntervalFormat The default date interval format string
     */
    public function setDateFormat($format = null, $dateIntervalFormat = null)
    {
        if (null !== $format) {
            $this->dateFormats[0] = $format;
        }

        if (null !== $dateIntervalFormat) {
            $this->dateFormats[1] = $dateIntervalFormat;
        }
    }

    /**
     * Gets the default format to be used by the date filter.
     *
     * @return array The default date format string and the default date interval format string
     */
    public function getDateFormat()
    {
        return $this->dateFormats;
    }

    /**
     * Sets the default timezone to be used by the date filter.
     *
     * @param DateTimeZone|string $timezone The default timezone string or a DateTimeZone object
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
    }

    /**
     * Gets the default timezone to be used by the date filter.
     *
     * @return DateTimeZone The default timezone currently in use
     */
    public function getTimezone()
    {
        if (null === $this->timezone) {
            $this->timezone = new DateTimeZone(date_default_timezone_get());
        }

        return $this->timezone;
    }

    /**
     * Sets the default format to be used by the number_format filter.
     *
     * @param int    $decimal      the number of decimal places to use
     * @param string $decimalPoint the character(s) to use for the decimal point
     * @param string $thousandSep  the character(s) to use for the thousands separator
     */
    public function setNumberFormat($decimal, $decimalPoint, $thousandSep)
    {
        $this->numberFormat = [$decimal, $decimalPoint, $thousandSep];
    }

    /**
     * Get the default format used by the number_format filter.
     *
     * @return array The arguments for number_format()
     */
    public function getNumberFormat()
    {
        return $this->numberFormat;
    }

    public function getTokenParsers()
    {
        return [
            new IfwPsn_Vendor_Twig_TokenParser_For(),
            new IfwPsn_Vendor_Twig_TokenParser_If(),
            new IfwPsn_Vendor_Twig_TokenParser_Extends(),
            new IfwPsn_Vendor_Twig_TokenParser_Include(),
            new IfwPsn_Vendor_Twig_TokenParser_Block(),
            new IfwPsn_Vendor_Twig_TokenParser_Use(),
            new IfwPsn_Vendor_Twig_TokenParser_Filter(),
            new IfwPsn_Vendor_Twig_TokenParser_Macro(),
            new IfwPsn_Vendor_Twig_TokenParser_Import(),
            new IfwPsn_Vendor_Twig_TokenParser_From(),
            new IfwPsn_Vendor_Twig_TokenParser_Set(),
            new IfwPsn_Vendor_Twig_TokenParser_Spaceless(),
            new IfwPsn_Vendor_Twig_TokenParser_Flush(),
            new IfwPsn_Vendor_Twig_TokenParser_Do(),
            new IfwPsn_Vendor_Twig_TokenParser_Embed(),
            new IfwPsn_Vendor_Twig_TokenParser_With(),
            new IfwPsn_Vendor_Twig_TokenParser_Deprecated(),
        ];
    }

    public function getFilters()
    {
        $filters = [
            // formatting filters
            new IfwPsn_Vendor_Twig_SimpleFilter('date', 'ifwpsn_twig_date_format_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('date_modify', 'ifwpsn_twig_date_modify_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('format', 'sprintf'),
            new IfwPsn_Vendor_Twig_SimpleFilter('replace', 'ifwpsn_twig_replace_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('number_format', 'ifwpsn_twig_number_format_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('abs', 'abs'),
            new IfwPsn_Vendor_Twig_SimpleFilter('round', 'ifwpsn_twig_round'),

            // encoding
            new IfwPsn_Vendor_Twig_SimpleFilter('url_encode', 'ifwpsn_twig_urlencode_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('json_encode', 'ifwpsn_twig_jsonencode_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('convert_encoding', 'ifwpsn_twig_convert_encoding'),

            // string filters
            new IfwPsn_Vendor_Twig_SimpleFilter('title', 'ifwpsn_twig_title_string_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('capitalize', 'ifwpsn_twig_capitalize_string_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('upper', 'strtoupper'),
            new IfwPsn_Vendor_Twig_SimpleFilter('lower', 'strtolower'),
            new IfwPsn_Vendor_Twig_SimpleFilter('striptags', 'strip_tags'),
            new IfwPsn_Vendor_Twig_SimpleFilter('trim', 'ifwpsn_twig_trim_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('nl2br', 'nl2br', ['pre_escape' => 'html', 'is_safe' => ['html']]),

            // array helpers
            new IfwPsn_Vendor_Twig_SimpleFilter('join', 'ifwpsn_twig_join_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('split', 'ifwpsn_twig_split_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('sort', 'ifwpsn_twig_sort_filter'),
            new IfwPsn_Vendor_Twig_SimpleFilter('merge', 'ifwpsn_twig_array_merge'),
            new IfwPsn_Vendor_Twig_SimpleFilter('batch', 'ifwpsn_twig_array_batch'),

            // string/array filters
            new IfwPsn_Vendor_Twig_SimpleFilter('reverse', 'ifwpsn_twig_reverse_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('length', 'ifwpsn_twig_length_filter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('slice', 'ifwpsn_twig_slice', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('first', 'ifwpsn_twig_first', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFilter('last', 'ifwpsn_twig_last', ['needs_environment' => true]),

            // iteration and runtime
            new IfwPsn_Vendor_Twig_SimpleFilter('default', '_ifwpsn_twig_default_filter', ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Filter_Default']),
            new IfwPsn_Vendor_Twig_SimpleFilter('keys', 'ifwpsn_twig_get_array_keys_filter'),

            // escaping
            new IfwPsn_Vendor_Twig_SimpleFilter('escape', 'ifwpsn_twig_escape_filter', ['needs_environment' => true, 'is_safe_callback' => 'ifwpsn_twig_escape_filter_is_safe']),
            new IfwPsn_Vendor_Twig_SimpleFilter('e', 'ifwpsn_twig_escape_filter', ['needs_environment' => true, 'is_safe_callback' => 'ifwpsn_twig_escape_filter_is_safe']),
        ];

        if (function_exists('mb_get_info')) {
            $filters[] = new IfwPsn_Vendor_Twig_SimpleFilter('upper', 'ifwpsn_twig_upper_filter', ['needs_environment' => true]);
            $filters[] = new IfwPsn_Vendor_Twig_SimpleFilter('lower', 'ifwpsn_twig_lower_filter', ['needs_environment' => true]);
        }

        return $filters;
    }

    public function getFunctions()
    {
        return [
            new IfwPsn_Vendor_Twig_SimpleFunction('max', 'max'),
            new IfwPsn_Vendor_Twig_SimpleFunction('min', 'min'),
            new IfwPsn_Vendor_Twig_SimpleFunction('range', 'range'),
            new IfwPsn_Vendor_Twig_SimpleFunction('constant', 'ifwpsn_twig_constant'),
            new IfwPsn_Vendor_Twig_SimpleFunction('cycle', 'ifwpsn_twig_cycle'),
            new IfwPsn_Vendor_Twig_SimpleFunction('random', 'ifwpsn_twig_random', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFunction('date', 'ifwpsn_twig_date_converter', ['needs_environment' => true]),
            new IfwPsn_Vendor_Twig_SimpleFunction('include', 'ifwpsn_twig_include', ['needs_environment' => true, 'needs_context' => true, 'is_safe' => ['all']]),
            new IfwPsn_Vendor_Twig_SimpleFunction('source', 'ifwpsn_twig_source', ['needs_environment' => true, 'is_safe' => ['all']]),
        ];
    }

    public function getTests()
    {
        return [
            new IfwPsn_Vendor_Twig_SimpleTest('even', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Even']),
            new IfwPsn_Vendor_Twig_SimpleTest('odd', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Odd']),
            new IfwPsn_Vendor_Twig_SimpleTest('defined', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Defined']),
            new IfwPsn_Vendor_Twig_SimpleTest('sameas', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Sameas', 'deprecated' => '1.21', 'alternative' => 'same as']),
            new IfwPsn_Vendor_Twig_SimpleTest('same as', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Sameas']),
            new IfwPsn_Vendor_Twig_SimpleTest('none', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Null']),
            new IfwPsn_Vendor_Twig_SimpleTest('null', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Null']),
            new IfwPsn_Vendor_Twig_SimpleTest('divisibleby', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Divisibleby', 'deprecated' => '1.21', 'alternative' => 'divisible by']),
            new IfwPsn_Vendor_Twig_SimpleTest('divisible by', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Divisibleby']),
            new IfwPsn_Vendor_Twig_SimpleTest('constant', null, ['node_class' => 'IfwPsn_Vendor_Twig_Node_Expression_Test_Constant']),
            new IfwPsn_Vendor_Twig_SimpleTest('empty', 'ifwpsn_twig_test_empty'),
            new IfwPsn_Vendor_Twig_SimpleTest('iterable', 'ifwpsn_twig_test_iterable'),
        ];
    }

    public function getOperators()
    {
        return [
            [
                'not' => ['precedence' => 50, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Unary_Not'],
                '-' => ['precedence' => 500, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Unary_Neg'],
                '+' => ['precedence' => 500, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Unary_Pos'],
            ],
            [
                'or' => ['precedence' => 10, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Or', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'and' => ['precedence' => 15, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_And', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'b-or' => ['precedence' => 16, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_BitwiseOr', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'b-xor' => ['precedence' => 17, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_BitwiseXor', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'b-and' => ['precedence' => 18, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_BitwiseAnd', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '==' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Equal', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '!=' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_NotEqual', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '<' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Less', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '>' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Greater', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '>=' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_GreaterEqual', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '<=' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_LessEqual', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'not in' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_NotIn', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'in' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_In', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'matches' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Matches', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'starts with' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_StartsWith', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'ends with' => ['precedence' => 20, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_EndsWith', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '..' => ['precedence' => 25, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Range', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '+' => ['precedence' => 30, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Add', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '-' => ['precedence' => 30, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Sub', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '~' => ['precedence' => 40, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Concat', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '*' => ['precedence' => 60, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Mul', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '/' => ['precedence' => 60, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Div', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '//' => ['precedence' => 60, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_FloorDiv', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '%' => ['precedence' => 60, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Mod', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'is' => ['precedence' => 100, 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                'is not' => ['precedence' => 100, 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_LEFT],
                '**' => ['precedence' => 200, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_Binary_Power', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_RIGHT],
                '??' => ['precedence' => 300, 'class' => 'IfwPsn_Vendor_Twig_Node_Expression_NullCoalesce', 'associativity' => IfwPsn_Vendor_Twig_ExpressionParser::OPERATOR_RIGHT],
            ],
        ];
    }

    public function getName()
    {
        return 'core';
    }
}

/**
 * Cycles over a value.
 *
 * @param ArrayAccess|array $values
 * @param int               $position The cycle position
 *
 * @return string The next value in the cycle
 */
function ifwpsn_twig_cycle($values, $position)
{
    if (!is_array($values) && !$values instanceof ArrayAccess) {
        return $values;
    }

    return $values[$position % count($values)];
}

/**
 * Returns a random value depending on the supplied parameter type:
 * - a random item from a Traversable or array
 * - a random character from a string
 * - a random integer between 0 and the integer parameter.
 *
 * @param IfwPsn_Vendor_Twig_Environment                   $env
 * @param Traversable|array|int|float|string $values The values to pick a random item from
 *
 * @throws IfwPsn_Vendor_Twig_Error_Runtime when $values is an empty array (does not apply to an empty string which is returned as is)
 *
 * @return mixed A random value from the given sequence
 */
function ifwpsn_twig_random(IfwPsn_Vendor_Twig_Environment $env, $values = null)
{
    if (null === $values) {
        return mt_rand();
    }

    if (is_int($values) || is_float($values)) {
        return $values < 0 ? mt_rand($values, 0) : mt_rand(0, $values);
    }

    if ($values instanceof Traversable) {
        $values = iterator_to_array($values);
    } elseif (is_string($values)) {
        if ('' === $values) {
            return '';
        }
        if (null !== $charset = $env->getCharset()) {
            if ('UTF-8' !== $charset) {
                $values = ifwpsn_twig_convert_encoding($values, 'UTF-8', $charset);
            }

            // unicode version of str_split()
            // split at all positions, but not after the start and not before the end
            $values = preg_split('/(?<!^)(?!$)/u', $values);

            if ('UTF-8' !== $charset) {
                foreach ($values as $i => $value) {
                    $values[$i] = ifwpsn_twig_convert_encoding($value, $charset, 'UTF-8');
                }
            }
        } else {
            return $values[mt_rand(0, strlen($values) - 1)];
        }
    }

    if (!is_array($values)) {
        return $values;
    }

    if (0 === count($values)) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime('The random function cannot pick from an empty array.');
    }

    return $values[array_rand($values, 1)];
}

/**
 * Converts a date to the given format.
 *
 * <pre>
 *   {{ post.published_at|date("m/d/Y") }}
 * </pre>
 *
 * @param IfwPsn_Vendor_Twig_Environment                               $env
 * @param DateTime|DateTimeInterface|DateInterval|string $date     A date
 * @param string|null                                    $format   The target format, null to use the default
 * @param DateTimeZone|string|false|null                 $timezone The target timezone, null to use the default, false to leave unchanged
 *
 * @return string The formatted date
 */
function ifwpsn_twig_date_format_filter(IfwPsn_Vendor_Twig_Environment $env, $date, $format = null, $timezone = null)
{
    if (null === $format) {
        $formats = $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getDateFormat();
        $format = $date instanceof DateInterval ? $formats[1] : $formats[0];
    }

    if ($date instanceof DateInterval) {
        return $date->format($format);
    }

    return ifwpsn_twig_date_converter($env, $date, $timezone)->format($format);
}

/**
 * Returns a new date object modified.
 *
 * <pre>
 *   {{ post.published_at|date_modify("-1day")|date("m/d/Y") }}
 * </pre>
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param DateTime|string  $date     A date
 * @param string           $modifier A modifier string
 *
 * @return DateTime A new date object
 */
function ifwpsn_twig_date_modify_filter(IfwPsn_Vendor_Twig_Environment $env, $date, $modifier)
{
    $date = ifwpsn_twig_date_converter($env, $date, false);
    $resultDate = $date->modify($modifier);

    // This is a hack to ensure PHP 5.2 support and support for DateTimeImmutable
    // DateTime::modify does not return the modified DateTime object < 5.3.0
    // and DateTimeImmutable does not modify $date.
    return null === $resultDate ? $date : $resultDate;
}

/**
 * Converts an input to a DateTime instance.
 *
 * <pre>
 *    {% if date(user.created_at) < date('+2days') %}
 *      {# do something #}
 *    {% endif %}
 * </pre>
 *
 * @param IfwPsn_Vendor_Twig_Environment                       $env
 * @param DateTime|DateTimeInterface|string|null $date     A date
 * @param DateTimeZone|string|false|null         $timezone The target timezone, null to use the default, false to leave unchanged
 *
 * @return DateTime A DateTime instance
 */
function ifwpsn_twig_date_converter(IfwPsn_Vendor_Twig_Environment $env, $date = null, $timezone = null)
{
    // determine the timezone
    if (false !== $timezone) {
        if (null === $timezone) {
            $timezone = $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getTimezone();
        } elseif (!$timezone instanceof DateTimeZone) {
            $timezone = new DateTimeZone($timezone);
        }
    }

    // immutable dates
    if ($date instanceof DateTimeImmutable) {
        return false !== $timezone ? $date->setTimezone($timezone) : $date;
    }

    if ($date instanceof DateTime || $date instanceof DateTimeInterface) {
        $date = clone $date;
        if (false !== $timezone) {
            $date->setTimezone($timezone);
        }

        return $date;
    }

    if (null === $date || 'now' === $date) {
        return new DateTime($date, false !== $timezone ? $timezone : $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getTimezone());
    }

    $asString = (string) $date;
    if (ctype_digit($asString) || (!empty($asString) && '-' === $asString[0] && ctype_digit(substr($asString, 1)))) {
        $date = new DateTime('@'.$date);
    } else {
        $date = new DateTime($date, $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getTimezone());
    }

    if (false !== $timezone) {
        $date->setTimezone($timezone);
    }

    return $date;
}

/**
 * Replaces strings within a string.
 *
 * @param string            $str  String to replace in
 * @param array|Traversable $from Replace values
 * @param string|null       $to   Replace to, deprecated (@see https://secure.php.net/manual/en/function.strtr.php)
 *
 * @return string
 */
function ifwpsn_twig_replace_filter($str, $from, $to = null)
{
    if ($from instanceof Traversable) {
        $from = iterator_to_array($from);
    } elseif (is_string($from) && is_string($to)) {
        @trigger_error('Using "replace" with character by character replacement is deprecated since version 1.22 and will be removed in Twig 2.0', E_USER_DEPRECATED);

        return strtr($str, $from, $to);
    } elseif (!is_array($from)) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime(sprintf('The "replace" filter expects an array or "Traversable" as replace values, got "%s".', is_object($from) ? get_class($from) : gettype($from)));
    }

    return strtr($str, $from);
}

/**
 * Rounds a number.
 *
 * @param int|float $value     The value to round
 * @param int|float $precision The rounding precision
 * @param string    $method    The method to use for rounding
 *
 * @return int|float The rounded number
 */
function ifwpsn_twig_round($value, $precision = 0, $method = 'common')
{
    if ('common' == $method) {
        return round($value, $precision);
    }

    if ('ceil' != $method && 'floor' != $method) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime('The round filter only supports the "common", "ceil", and "floor" methods.');
    }

    return $method($value * pow(10, $precision)) / pow(10, $precision);
}

/**
 * Number format filter.
 *
 * All of the formatting options can be left null, in that case the defaults will
 * be used.  Supplying any of the parameters will override the defaults set in the
 * environment object.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param mixed            $number       A float/int/string of the number to format
 * @param int              $decimal      the number of decimal points to display
 * @param string           $decimalPoint the character(s) to use for the decimal point
 * @param string           $thousandSep  the character(s) to use for the thousands separator
 *
 * @return string The formatted number
 */
function ifwpsn_twig_number_format_filter(IfwPsn_Vendor_Twig_Environment $env, $number, $decimal = null, $decimalPoint = null, $thousandSep = null)
{
    $defaults = $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getNumberFormat();
    if (null === $decimal) {
        $decimal = $defaults[0];
    }

    if (null === $decimalPoint) {
        $decimalPoint = $defaults[1];
    }

    if (null === $thousandSep) {
        $thousandSep = $defaults[2];
    }

    return number_format((float) $number, $decimal, $decimalPoint, $thousandSep);
}

/**
 * URL encodes (RFC 3986) a string as a path segment or an array as a query string.
 *
 * @param string|array $url A URL or an array of query parameters
 *
 * @return string The URL encoded value
 */
function ifwpsn_twig_urlencode_filter($url)
{
    if (is_array($url)) {
        if (defined('PHP_QUERY_RFC3986')) {
            return http_build_query($url, '', '&', PHP_QUERY_RFC3986);
        }

        return http_build_query($url, '', '&');
    }

    return rawurlencode($url);
}

/**
 * JSON encodes a variable.
 *
 * @param mixed $value   the value to encode
 * @param int   $options Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_NUMERIC_CHECK, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES, JSON_FORCE_OBJECT
 *
 * @return mixed The JSON encoded value
 */
function ifwpsn_twig_jsonencode_filter($value, $options = 0)
{
    if ($value instanceof IfwPsn_Vendor_Twig_Markup) {
        $value = (string) $value;
    } elseif (is_array($value)) {
        array_walk_recursive($value, '_ifwpsn_twig_markup2string');
    }

    return json_encode($value, $options);
}

function _ifwpsn_twig_markup2string(&$value)
{
    if ($value instanceof IfwPsn_Vendor_Twig_Markup) {
        $value = (string) $value;
    }
}

/**
 * Merges an array with another one.
 *
 * <pre>
 *  {% set items = { 'apple': 'fruit', 'orange': 'fruit' } %}
 *
 *  {% set items = items|merge({ 'peugeot': 'car' }) %}
 *
 *  {# items now contains { 'apple': 'fruit', 'orange': 'fruit', 'peugeot': 'car' } #}
 * </pre>
 *
 * @param array|Traversable $arr1 An array
 * @param array|Traversable $arr2 An array
 *
 * @return array The merged array
 */
function ifwpsn_twig_array_merge($arr1, $arr2)
{
    if ($arr1 instanceof Traversable) {
        $arr1 = iterator_to_array($arr1);
    } elseif (!is_array($arr1)) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
    }

    if ($arr2 instanceof Traversable) {
        $arr2 = iterator_to_array($arr2);
    } elseif (!is_array($arr2)) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
    }

    return array_merge($arr1, $arr2);
}

/**
 * Slices a variable.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param mixed            $item         A variable
 * @param int              $start        Start of the slice
 * @param int              $length       Size of the slice
 * @param bool             $preserveKeys Whether to preserve key or not (when the input is an array)
 *
 * @return mixed The sliced variable
 */
function ifwpsn_twig_slice(IfwPsn_Vendor_Twig_Environment $env, $item, $start, $length = null, $preserveKeys = false)
{
    if ($item instanceof Traversable) {
        while ($item instanceof IteratorAggregate) {
            $item = $item->getIterator();
        }

        if ($start >= 0 && $length >= 0 && $item instanceof Iterator) {
            try {
                return iterator_to_array(new LimitIterator($item, $start, null === $length ? -1 : $length), $preserveKeys);
            } catch (OutOfBoundsException $exception) {
                return [];
            }
        }

        $item = iterator_to_array($item, $preserveKeys);
    }

    if (is_array($item)) {
        return array_slice($item, $start, $length, $preserveKeys);
    }

    $item = (string) $item;

    if (function_exists('mb_get_info') && null !== $charset = $env->getCharset()) {
        return (string) mb_substr($item, $start, null === $length ? mb_strlen($item, $charset) - $start : $length, $charset);
    }

    return (string) (null === $length ? substr($item, $start) : substr($item, $start, $length));
}

/**
 * Returns the first element of the item.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param mixed            $item A variable
 *
 * @return mixed The first element of the item
 */
function ifwpsn_twig_first(IfwPsn_Vendor_Twig_Environment $env, $item)
{
    $elements = ifwpsn_twig_slice($env, $item, 0, 1, false);

    return is_string($elements) ? $elements : current($elements);
}

/**
 * Returns the last element of the item.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param mixed            $item A variable
 *
 * @return mixed The last element of the item
 */
function ifwpsn_twig_last(IfwPsn_Vendor_Twig_Environment $env, $item)
{
    $elements = ifwpsn_twig_slice($env, $item, -1, 1, false);

    return is_string($elements) ? $elements : current($elements);
}

/**
 * Joins the values to a string.
 *
 * The separators between elements are empty strings per default, you can define them with the optional parameters.
 *
 * <pre>
 *  {{ [1, 2, 3]|join(', ', ' and ') }}
 *  {# returns 1, 2 and 3 #}
 *
 *  {{ [1, 2, 3]|join('|') }}
 *  {# returns 1|2|3 #}
 *
 *  {{ [1, 2, 3]|join }}
 *  {# returns 123 #}
 * </pre>
 *
 * @param array       $value An array
 * @param string      $glue  The separator
 * @param string|null $and   The separator for the last pair
 *
 * @return string The concatenated string
 */
function ifwpsn_twig_join_filter($value, $glue = '', $and = null)
{
    if ($value instanceof Traversable) {
        $value = iterator_to_array($value, false);
    } else {
        $value = (array) $value;
    }

    if (0 === count($value)) {
        return '';
    }

    if (null === $and || $and === $glue) {
        return implode($glue, $value);
    }

    $v = array_values($value);
    if (1 === count($v)) {
        return $v[0];
    }

    return implode($glue, array_slice($value, 0, -1)).$and.$v[count($v) - 1];
}

/**
 * Splits the string into an array.
 *
 * <pre>
 *  {{ "one,two,three"|split(',') }}
 *  {# returns [one, two, three] #}
 *
 *  {{ "one,two,three,four,five"|split(',', 3) }}
 *  {# returns [one, two, "three,four,five"] #}
 *
 *  {{ "123"|split('') }}
 *  {# returns [1, 2, 3] #}
 *
 *  {{ "aabbcc"|split('', 2) }}
 *  {# returns [aa, bb, cc] #}
 * </pre>
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param string           $value     A string
 * @param string           $delimiter The delimiter
 * @param int              $limit     The limit
 *
 * @return array The split string as an array
 */
function ifwpsn_twig_split_filter(IfwPsn_Vendor_Twig_Environment $env, $value, $delimiter, $limit = null)
{
    if (!empty($delimiter)) {
        return null === $limit ? explode($delimiter, $value) : explode($delimiter, $value, $limit);
    }

    if (!function_exists('mb_get_info') || null === $charset = $env->getCharset()) {
        return str_split($value, null === $limit ? 1 : $limit);
    }

    if ($limit <= 1) {
        return preg_split('/(?<!^)(?!$)/u', $value);
    }

    $length = mb_strlen($value, $charset);
    if ($length < $limit) {
        return [$value];
    }

    $r = [];
    for ($i = 0; $i < $length; $i += $limit) {
        $r[] = mb_substr($value, $i, $limit, $charset);
    }

    return $r;
}

// The '_default' filter is used internally to avoid using the ternary operator
// which costs a lot for big contexts (before PHP 5.4). So, on average,
// a function call is cheaper.
/**
 * @internal
 */
function _ifwpsn_twig_default_filter($value, $default = '')
{
    if (ifwpsn_twig_test_empty($value)) {
        return $default;
    }

    return $value;
}

/**
 * Returns the keys for the given array.
 *
 * It is useful when you want to iterate over the keys of an array:
 *
 * <pre>
 *  {% for key in array|keys %}
 *      {# ... #}
 *  {% endfor %}
 * </pre>
 *
 * @param array $array An array
 *
 * @return array The keys
 */
function ifwpsn_twig_get_array_keys_filter($array)
{
    if ($array instanceof Traversable) {
        while ($array instanceof IteratorAggregate) {
            $array = $array->getIterator();
        }

        if ($array instanceof Iterator) {
            $keys = [];
            $array->rewind();
            while ($array->valid()) {
                $keys[] = $array->key();
                $array->next();
            }

            return $keys;
        }

        $keys = [];
        foreach ($array as $key => $item) {
            $keys[] = $key;
        }

        return $keys;
    }

    if (!is_array($array)) {
        return [];
    }

    return array_keys($array);
}

/**
 * Reverses a variable.
 *
 * @param IfwPsn_Vendor_Twig_Environment         $env
 * @param array|Traversable|string $item         An array, a Traversable instance, or a string
 * @param bool                     $preserveKeys Whether to preserve key or not
 *
 * @return mixed The reversed input
 */
function ifwpsn_twig_reverse_filter(IfwPsn_Vendor_Twig_Environment $env, $item, $preserveKeys = false)
{
    if ($item instanceof Traversable) {
        return array_reverse(iterator_to_array($item), $preserveKeys);
    }

    if (is_array($item)) {
        return array_reverse($item, $preserveKeys);
    }

    if (null !== $charset = $env->getCharset()) {
        $string = (string) $item;

        if ('UTF-8' !== $charset) {
            $item = ifwpsn_twig_convert_encoding($string, 'UTF-8', $charset);
        }

        preg_match_all('/./us', $item, $matches);

        $string = implode('', array_reverse($matches[0]));

        if ('UTF-8' !== $charset) {
            $string = ifwpsn_twig_convert_encoding($string, $charset, 'UTF-8');
        }

        return $string;
    }

    return strrev((string) $item);
}

/**
 * Sorts an array.
 *
 * @param array|Traversable $array
 *
 * @return array
 */
function ifwpsn_twig_sort_filter($array)
{
    if ($array instanceof Traversable) {
        $array = iterator_to_array($array);
    } elseif (!is_array($array)) {
        throw new IfwPsn_Vendor_Twig_Error_Runtime(sprintf('The sort filter only works with arrays or "Traversable", got "%s".', gettype($array)));
    }

    asort($array);

    return $array;
}

/**
 * @internal
 */
function ifwpsn_twig_in_filter($value, $compare)
{
    if (is_array($compare)) {
        return in_array($value, $compare, is_object($value) || is_resource($value));
    } elseif (is_string($compare) && (is_string($value) || is_int($value) || is_float($value))) {
        return '' === $value || false !== strpos($compare, (string) $value);
    } elseif ($compare instanceof Traversable) {
        if (is_object($value) || is_resource($value)) {
            foreach ($compare as $item) {
                if ($item === $value) {
                    return true;
                }
            }
        } else {
            foreach ($compare as $item) {
                if ($item == $value) {
                    return true;
                }
            }
        }

        return false;
    }

    return false;
}

/**
 * Returns a trimmed string.
 *
 * @return string
 *
 * @throws IfwPsn_Vendor_Twig_Error_Runtime When an invalid trimming side is used (not a string or not 'left', 'right', or 'both')
 */
function ifwpsn_twig_trim_filter($string, $characterMask = null, $side = 'both')
{
    if (null === $characterMask) {
        $characterMask = " \t\n\r\0\x0B";
    }

    switch ($side) {
        case 'both':
            return trim($string, $characterMask);
        case 'left':
            return ltrim($string, $characterMask);
        case 'right':
            return rtrim($string, $characterMask);
        default:
            throw new IfwPsn_Vendor_Twig_Error_Runtime('Trimming side must be "left", "right" or "both".');
    }
}

/**
 * Escapes a string.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param mixed            $string     The value to be escaped
 * @param string           $strategy   The escaping strategy
 * @param string           $charset    The charset
 * @param bool             $autoescape Whether the function is called by the auto-escaping feature (true) or by the developer (false)
 *
 * @return string
 */
function ifwpsn_twig_escape_filter(IfwPsn_Vendor_Twig_Environment $env, $string, $strategy = 'html', $charset = null, $autoescape = false)
{
    if ($autoescape && $string instanceof IfwPsn_Vendor_Twig_Markup) {
        return $string;
    }

    if (!is_string($string)) {
        if (is_object($string) && method_exists($string, '__toString')) {
            $string = (string) $string;
        } elseif (in_array($strategy, ['html', 'js', 'css', 'html_attr', 'url'])) {
            return $string;
        }
    }

    if ('' === $string) {
        return '';
    }

    if (null === $charset) {
        $charset = $env->getCharset();
    }

    switch ($strategy) {
        case 'html':
            // see https://secure.php.net/htmlspecialchars

            // Using a static variable to avoid initializing the array
            // each time the function is called. Moving the declaration on the
            // top of the function slow downs other escaping strategies.
            static $htmlspecialcharsCharsets = [
                'ISO-8859-1' => true, 'ISO8859-1' => true,
                'ISO-8859-15' => true, 'ISO8859-15' => true,
                'utf-8' => true, 'UTF-8' => true,
                'CP866' => true, 'IBM866' => true, '866' => true,
                'CP1251' => true, 'WINDOWS-1251' => true, 'WIN-1251' => true,
                '1251' => true,
                'CP1252' => true, 'WINDOWS-1252' => true, '1252' => true,
                'KOI8-R' => true, 'KOI8-RU' => true, 'KOI8R' => true,
                'BIG5' => true, '950' => true,
                'GB2312' => true, '936' => true,
                'BIG5-HKSCS' => true,
                'SHIFT_JIS' => true, 'SJIS' => true, '932' => true,
                'EUC-JP' => true, 'EUCJP' => true,
                'ISO8859-5' => true, 'ISO-8859-5' => true, 'MACROMAN' => true,
            ];

            if (isset($htmlspecialcharsCharsets[$charset])) {
                return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
            }

            if (isset($htmlspecialcharsCharsets[strtoupper($charset)])) {
                // cache the lowercase variant for future iterations
                $htmlspecialcharsCharsets[$charset] = true;

                return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
            }

            $string = ifwpsn_twig_convert_encoding($string, 'UTF-8', $charset);
            $string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

            return ifwpsn_twig_convert_encoding($string, $charset, 'UTF-8');

        case 'js':
            // escape all non-alphanumeric characters
            // into their \x or \uHHHH representations
            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new IfwPsn_Vendor_Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9,\._]#Su', '_ifwpsn_twig_escape_js_callback', $string);

            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, $charset, 'UTF-8');
            }

            return $string;

        case 'css':
            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new IfwPsn_Vendor_Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9]#Su', '_ifwpsn_twig_escape_css_callback', $string);

            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, $charset, 'UTF-8');
            }

            return $string;

        case 'html_attr':
            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, 'UTF-8', $charset);
            }

            if (!preg_match('//u', $string)) {
                throw new IfwPsn_Vendor_Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
            }

            $string = preg_replace_callback('#[^a-zA-Z0-9,\.\-_]#Su', '_ifwpsn_twig_escape_html_attr_callback', $string);

            if ('UTF-8' !== $charset) {
                $string = ifwpsn_twig_convert_encoding($string, $charset, 'UTF-8');
            }

            return $string;

        case 'url':
            return rawurlencode($string);

        default:
            static $escapers;

            if (null === $escapers) {
                $escapers = $env->getExtension('IfwPsn_Vendor_Twig_Extension_Core')->getEscapers();
            }

            if (isset($escapers[$strategy])) {
                return call_user_func($escapers[$strategy], $env, $string, $charset);
            }

            $validStrategies = implode(', ', array_merge(['html', 'js', 'url', 'css', 'html_attr'], array_keys($escapers)));

            throw new IfwPsn_Vendor_Twig_Error_Runtime(sprintf('Invalid escaping strategy "%s" (valid ones: %s).', $strategy, $validStrategies));
    }
}

/**
 * @internal
 */
function ifwpsn_twig_escape_filter_is_safe(IfwPsn_Vendor_Twig_Node $filterArgs)
{
    foreach ($filterArgs as $arg) {
        if ($arg instanceof IfwPsn_Vendor_Twig_Node_Expression_Constant) {
            return [$arg->getAttribute('value')];
        }

        return [];
    }

    return ['html'];
}

if (function_exists('mb_convert_encoding')) {
    function ifwpsn_twig_convert_encoding($string, $to, $from)
    {
        return mb_convert_encoding($string, $to, $from);
    }
} elseif (function_exists('iconv')) {
    function ifwpsn_twig_convert_encoding($string, $to, $from)
    {
        return iconv($from, $to, $string);
    }
} else {
    function ifwpsn_twig_convert_encoding($string, $to, $from)
    {
        throw new IfwPsn_Vendor_Twig_Error_Runtime('No suitable convert encoding function (use UTF-8 as your encoding or install the iconv or mbstring extension).');
    }
}

if (function_exists('mb_ord')) {
    function ifwpsn_twig_ord($string)
    {
        return mb_ord($string, 'UTF-8');
    }
} else {
    function ifwpsn_twig_ord($string)
    {
        $code = ($string = unpack('C*', substr($string, 0, 4))) ? $string[1] : 0;
        if (0xF0 <= $code) {
            return (($code - 0xF0) << 18) + (($string[2] - 0x80) << 12) + (($string[3] - 0x80) << 6) + $string[4] - 0x80;
        }
        if (0xE0 <= $code) {
            return (($code - 0xE0) << 12) + (($string[2] - 0x80) << 6) + $string[3] - 0x80;
        }
        if (0xC0 <= $code) {
            return (($code - 0xC0) << 6) + $string[2] - 0x80;
        }

        return $code;
    }
}

function _ifwpsn_twig_escape_js_callback($matches)
{
    $char = $matches[0];

    /*
     * A few characters have short escape sequences in JSON and JavaScript.
     * Escape sequences supported only by JavaScript, not JSON, are ommitted.
     * \" is also supported but omitted, because the resulting string is not HTML safe.
     */
    static $shortMap = [
        '\\' => '\\\\',
        '/' => '\\/',
        "\x08" => '\b',
        "\x0C" => '\f',
        "\x0A" => '\n',
        "\x0D" => '\r',
        "\x09" => '\t',
    ];

    if (isset($shortMap[$char])) {
        return $shortMap[$char];
    }

    // \uHHHH
    $char = ifwpsn_twig_convert_encoding($char, 'UTF-16BE', 'UTF-8');
    $char = strtoupper(bin2hex($char));

    if (4 >= strlen($char)) {
        return sprintf('\u%04s', $char);
    }

    return sprintf('\u%04s\u%04s', substr($char, 0, -4), substr($char, -4));
}

function _ifwpsn_twig_escape_css_callback($matches)
{
    $char = $matches[0];

    return sprintf('\\%X ', 1 === strlen($char) ? ord($char) : ifwpsn_twig_ord($char));
}

/**
 * This function is adapted from code coming from Zend Framework.
 *
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://framework.zend.com/license/new-bsd New BSD License
 */
function _ifwpsn_twig_escape_html_attr_callback($matches)
{
    $chr = $matches[0];
    $ord = ord($chr);

    /*
     * The following replaces characters undefined in HTML with the
     * hex entity for the Unicode replacement character.
     */
    if (($ord <= 0x1f && "\t" != $chr && "\n" != $chr && "\r" != $chr) || ($ord >= 0x7f && $ord <= 0x9f)) {
        return '&#xFFFD;';
    }

    /*
     * Check if the current character to escape has a name entity we should
     * replace it with while grabbing the hex value of the character.
     */
    if (1 == strlen($chr)) {
        /*
         * While HTML supports far more named entities, the lowest common denominator
         * has become HTML5's XML Serialisation which is restricted to the those named
         * entities that XML supports. Using HTML entities would result in this error:
         *     XML Parsing Error: undefined entity
         */
        static $entityMap = [
            34 => '&quot;', /* quotation mark */
            38 => '&amp;',  /* ampersand */
            60 => '&lt;',   /* less-than sign */
            62 => '&gt;',   /* greater-than sign */
        ];

        if (isset($entityMap[$ord])) {
            return $entityMap[$ord];
        }

        return sprintf('&#x%02X;', $ord);
    }

    /*
     * Per OWASP recommendations, we'll use hex entities for any other
     * characters where a named entity does not exist.
     */
    return sprintf('&#x%04X;', ifwpsn_twig_ord($chr));
}

// add multibyte extensions if possible
if (function_exists('mb_get_info')) {
    /**
     * Returns the length of a variable.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param mixed            $thing A variable
     *
     * @return int The length of the value
     */
    function ifwpsn_twig_length_filter(IfwPsn_Vendor_Twig_Environment $env, $thing)
    {
        if (null === $thing) {
            return 0;
        }

        if (is_scalar($thing)) {
            return mb_strlen($thing, $env->getCharset());
        }

        if ($thing instanceof \SimpleXMLElement) {
            return count($thing);
        }

        if (is_object($thing) && method_exists($thing, '__toString') && !$thing instanceof \Countable) {
            return mb_strlen((string) $thing, $env->getCharset());
        }

        if ($thing instanceof \Countable || is_array($thing)) {
            return count($thing);
        }

        if ($thing instanceof \IteratorAggregate) {
            return iterator_count($thing);
        }

        return 1;
    }

    /**
     * Converts a string to uppercase.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The uppercased string
     */
    function ifwpsn_twig_upper_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        if (null !== $charset = $env->getCharset()) {
            return mb_strtoupper($string, $charset);
        }

        return strtoupper($string);
    }

    /**
     * Converts a string to lowercase.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The lowercased string
     */
    function ifwpsn_twig_lower_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        if (null !== $charset = $env->getCharset()) {
            return mb_strtolower($string, $charset);
        }

        return strtolower($string);
    }

    /**
     * Returns a titlecased string.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The titlecased string
     */
    function ifwpsn_twig_title_string_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        if (null !== $charset = $env->getCharset()) {
            return mb_convert_case($string, MB_CASE_TITLE, $charset);
        }

        return ucwords(strtolower($string));
    }

    /**
     * Returns a capitalized string.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The capitalized string
     */
    function ifwpsn_twig_capitalize_string_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        if (null !== $charset = $env->getCharset()) {
            return mb_strtoupper(mb_substr($string, 0, 1, $charset), $charset).mb_strtolower(mb_substr($string, 1, mb_strlen($string, $charset), $charset), $charset);
        }

        return ucfirst(strtolower($string));
    }
}
// and byte fallback
else {
    /**
     * Returns the length of a variable.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param mixed            $thing A variable
     *
     * @return int The length of the value
     */
    function ifwpsn_twig_length_filter(IfwPsn_Vendor_Twig_Environment $env, $thing)
    {
        if (null === $thing) {
            return 0;
        }

        if (is_scalar($thing)) {
            return strlen($thing);
        }

        if ($thing instanceof \SimpleXMLElement) {
            return count($thing);
        }

        if (is_object($thing) && method_exists($thing, '__toString') && !$thing instanceof \Countable) {
            return strlen((string) $thing);
        }

        if ($thing instanceof \Countable || is_array($thing)) {
            return count($thing);
        }

        if ($thing instanceof \IteratorAggregate) {
            return iterator_count($thing);
        }

        return 1;
    }

    /**
     * Returns a titlecased string.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The titlecased string
     */
    function ifwpsn_twig_title_string_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        return ucwords(strtolower($string));
    }

    /**
     * Returns a capitalized string.
     *
     * @param IfwPsn_Vendor_Twig_Environment $env
     * @param string           $string A string
     *
     * @return string The capitalized string
     */
    function ifwpsn_twig_capitalize_string_filter(IfwPsn_Vendor_Twig_Environment $env, $string)
    {
        return ucfirst(strtolower($string));
    }
}

/**
 * @internal
 */
function ifwpsn_twig_ensure_traversable($seq)
{
    if ($seq instanceof Traversable || is_array($seq)) {
        return $seq;
    }

    return [];
}

/**
 * Checks if a variable is empty.
 *
 * <pre>
 * {# evaluates to true if the foo variable is null, false, or the empty string #}
 * {% if foo is empty %}
 *     {# ... #}
 * {% endif %}
 * </pre>
 *
 * @param mixed $value A variable
 *
 * @return bool true if the value is empty, false otherwise
 */
function ifwpsn_twig_test_empty($value)
{
    if ($value instanceof Countable) {
        return 0 == count($value);
    }

    if (is_object($value) && method_exists($value, '__toString')) {
        return '' === (string) $value;
    }

    return '' === $value || false === $value || null === $value || [] === $value;
}

/**
 * Checks if a variable is traversable.
 *
 * <pre>
 * {# evaluates to true if the foo variable is an array or a traversable object #}
 * {% if foo is iterable %}
 *     {# ... #}
 * {% endif %}
 * </pre>
 *
 * @param mixed $value A variable
 *
 * @return bool true if the value is traversable
 */
function ifwpsn_twig_test_iterable($value)
{
    return $value instanceof Traversable || is_array($value);
}

/**
 * Renders a template.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param array            $context
 * @param string|array     $template      The template to render or an array of templates to try consecutively
 * @param array            $variables     The variables to pass to the template
 * @param bool             $withContext
 * @param bool             $ignoreMissing Whether to ignore missing templates or not
 * @param bool             $sandboxed     Whether to sandbox the template or not
 *
 * @return string The rendered template
 */
function ifwpsn_twig_include(IfwPsn_Vendor_Twig_Environment $env, $context, $template, $variables = [], $withContext = true, $ignoreMissing = false, $sandboxed = false)
{
    $alreadySandboxed = false;
    $sandbox = null;
    if ($withContext) {
        $variables = array_merge($context, $variables);
    }

    if ($isSandboxed = $sandboxed && $env->hasExtension('IfwPsn_Vendor_Twig_Extension_Sandbox')) {
        $sandbox = $env->getExtension('IfwPsn_Vendor_Twig_Extension_Sandbox');
        if (!$alreadySandboxed = $sandbox->isSandboxed()) {
            $sandbox->enableSandbox();
        }
    }

    $result = '';
    try {
        $result = $env->resolveTemplate($template)->render($variables);
    } catch (IfwPsn_Vendor_Twig_Error_Loader $e) {
        if (!$ignoreMissing) {
            if ($isSandboxed && !$alreadySandboxed) {
                $sandbox->disableSandbox();
            }

            throw $e;
        }
    } catch (Throwable $e) {
        if ($isSandboxed && !$alreadySandboxed) {
            $sandbox->disableSandbox();
        }

        throw $e;
    } catch (Exception $e) {
        if ($isSandboxed && !$alreadySandboxed) {
            $sandbox->disableSandbox();
        }

        throw $e;
    }

    if ($isSandboxed && !$alreadySandboxed) {
        $sandbox->disableSandbox();
    }

    return $result;
}

/**
 * Returns a template content without rendering it.
 *
 * @param IfwPsn_Vendor_Twig_Environment $env
 * @param string           $name          The template name
 * @param bool             $ignoreMissing Whether to ignore missing templates or not
 *
 * @return string The template source
 */
function ifwpsn_twig_source(IfwPsn_Vendor_Twig_Environment $env, $name, $ignoreMissing = false)
{
    $loader = $env->getLoader();
    try {
        if (!$loader instanceof IfwPsn_Vendor_Twig_SourceContextLoaderInterface) {
            return $loader->getSource($name);
        } else {
            return $loader->getSourceContext($name)->getCode();
        }
    } catch (IfwPsn_Vendor_Twig_Error_Loader $e) {
        if (!$ignoreMissing) {
            throw $e;
        }
    }
}

/**
 * Provides the ability to get constants from instances as well as class/global constants.
 *
 * @param string      $constant The name of the constant
 * @param object|null $object   The object to get the constant from
 *
 * @return string
 */
function ifwpsn_twig_constant($constant, $object = null)
{
    if (null !== $object) {
        $constant = get_class($object).'::'.$constant;
    }

    return constant($constant);
}

/**
 * Checks if a constant exists.
 *
 * @param string      $constant The name of the constant
 * @param object|null $object   The object to get the constant from
 *
 * @return bool
 */
function ifwpsn_twig_constant_is_defined($constant, $object = null)
{
    if (null !== $object) {
        $constant = get_class($object).'::'.$constant;
    }

    return defined($constant);
}

/**
 * Batches item.
 *
 * @param array $items An array of items
 * @param int   $size  The size of the batch
 * @param mixed $fill  A value used to fill missing items
 *
 * @return array
 */
function ifwpsn_twig_array_batch($items, $size, $fill = null)
{
    if ($items instanceof Traversable) {
        $items = iterator_to_array($items, false);
    }

    $size = ceil($size);

    $result = array_chunk($items, $size, true);

    if (null !== $fill && !empty($result)) {
        $last = count($result) - 1;
        if ($fillCount = $size - count($result[$last])) {
            $result[$last] = array_merge(
                $result[$last],
                array_fill(0, $fillCount, $fill)
            );
        }
    }

    return $result;
}

//class_alias('IfwPsn_Vendor_Twig_Extension_Core', 'Twig\Extension\CoreExtension', false);
