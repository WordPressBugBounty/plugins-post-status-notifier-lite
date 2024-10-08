<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Loops over each item of a sequence.
 *
 * <pre>
 * <ul>
 *  {% for user in users %}
 *    <li>{{ user.username|e }}</li>
 *  {% endfor %}
 * </ul>
 * </pre>
 *
 * @final
 */
class IfwPsn_Vendor_Twig_TokenParser_For extends IfwPsn_Vendor_Twig_TokenParser
{
    public function parse(IfwPsn_Vendor_Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $targets = $this->parser->getExpressionParser()->parseAssignmentExpression();
        $stream->expect(IfwPsn_Vendor_Twig_Token::OPERATOR_TYPE, 'in');
        $seq = $this->parser->getExpressionParser()->parseExpression();

        $ifexpr = null;
        if ($stream->nextIf(IfwPsn_Vendor_Twig_Token::NAME_TYPE, 'if')) {
            $ifexpr = $this->parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(IfwPsn_Vendor_Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideForFork']);
        if ('else' == $stream->next()->getValue()) {
            $stream->expect(IfwPsn_Vendor_Twig_Token::BLOCK_END_TYPE);
            $else = $this->parser->subparse([$this, 'decideForEnd'], true);
        } else {
            $else = null;
        }
        $stream->expect(IfwPsn_Vendor_Twig_Token::BLOCK_END_TYPE);

        if (count($targets) > 1) {
            $keyTarget = $targets->getNode(0);
            $keyTarget = new IfwPsn_Vendor_Twig_Node_Expression_AssignName($keyTarget->getAttribute('name'), $keyTarget->getTemplateLine());
            $valueTarget = $targets->getNode(1);
            $valueTarget = new IfwPsn_Vendor_Twig_Node_Expression_AssignName($valueTarget->getAttribute('name'), $valueTarget->getTemplateLine());
        } else {
            $keyTarget = new IfwPsn_Vendor_Twig_Node_Expression_AssignName('_key', $lineno);
            $valueTarget = $targets->getNode(0);
            $valueTarget = new IfwPsn_Vendor_Twig_Node_Expression_AssignName($valueTarget->getAttribute('name'), $valueTarget->getTemplateLine());
        }

        if ($ifexpr) {
            $this->checkLoopUsageCondition($stream, $ifexpr);
            $this->checkLoopUsageBody($stream, $body);
        }

        return new IfwPsn_Vendor_Twig_Node_For($keyTarget, $valueTarget, $seq, $ifexpr, $body, $else, $lineno, $this->getTag());
    }

    public function decideForFork(IfwPsn_Vendor_Twig_Token $token)
    {
        return $token->test(['else', 'endfor']);
    }

    public function decideForEnd(IfwPsn_Vendor_Twig_Token $token)
    {
        return $token->test('endfor');
    }

    // the loop variable cannot be used in the condition
    protected function checkLoopUsageCondition(IfwPsn_Vendor_Twig_TokenStream $stream, IfwPsn_Vendor_Twig_NodeInterface $node)
    {
        if ($node instanceof IfwPsn_Vendor_Twig_Node_Expression_GetAttr && $node->getNode('node') instanceof IfwPsn_Vendor_Twig_Node_Expression_Name && 'loop' == $node->getNode('node')->getAttribute('name')) {
            throw new IfwPsn_Vendor_Twig_Error_Syntax('The "loop" variable cannot be used in a looping condition.', $node->getTemplateLine(), $stream->getSourceContext());
        }

        foreach ($node as $n) {
            if (!$n) {
                continue;
            }

            $this->checkLoopUsageCondition($stream, $n);
        }
    }

    // check usage of non-defined loop-items
    // it does not catch all problems (for instance when a for is included into another or when the variable is used in an include)
    protected function checkLoopUsageBody(IfwPsn_Vendor_Twig_TokenStream $stream, IfwPsn_Vendor_Twig_NodeInterface $node)
    {
        if ($node instanceof IfwPsn_Vendor_Twig_Node_Expression_GetAttr && $node->getNode('node') instanceof IfwPsn_Vendor_Twig_Node_Expression_Name && 'loop' == $node->getNode('node')->getAttribute('name')) {
            $attribute = $node->getNode('attribute');
            if ($attribute instanceof IfwPsn_Vendor_Twig_Node_Expression_Constant && in_array($attribute->getAttribute('value'), ['length', 'revindex0', 'revindex', 'last'])) {
                throw new IfwPsn_Vendor_Twig_Error_Syntax(sprintf('The "loop.%s" variable is not defined when looping with a condition.', $attribute->getAttribute('value')), $node->getTemplateLine(), $stream->getSourceContext());
            }
        }

        // should check for parent.loop.XXX usage
        if ($node instanceof IfwPsn_Vendor_Twig_Node_For) {
            return;
        }

        foreach ($node as $n) {
            if (!$n) {
                continue;
            }

            $this->checkLoopUsageBody($stream, $n);
        }
    }

    public function getTag()
    {
        return 'for';
    }
}

//class_alias('IfwPsn_Vendor_Twig_TokenParser_For', 'Twig\TokenParser\ForTokenParser', false);
