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

/**
 * Interface implemented by token parser brokers.
 *
 * Token parser brokers allows to implement custom logic in the process of resolving a token parser for a given tag name.
 *
 * @author Arnaud Le Blanc <arnaud.lb@gmail.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
interface IfwPsn_Vendor_Twig_TokenParserBrokerInterface
{
    /**
     * Gets a TokenParser suitable for a tag.
     *
     * @param string $tag A tag name
     *
     * @return IfwPsn_Vendor_Twig_TokenParserInterface|null A IfwPsn_Vendor_Twig_TokenParserInterface or null if no suitable TokenParser was found
     */
    public function getTokenParser($tag);

    /**
     * Calls IfwPsn_Vendor_Twig_TokenParserInterface::setParser on all parsers the implementation knows of.
     */
    public function setParser(IfwPsn_Vendor_Twig_ParserInterface $parser);

    /**
     * Gets the IfwPsn_Vendor_Twig_ParserInterface.
     *
     * @return IfwPsn_Vendor_Twig_ParserInterface|null A IfwPsn_Vendor_Twig_ParserInterface instance or null
     */
    public function getParser();
}
