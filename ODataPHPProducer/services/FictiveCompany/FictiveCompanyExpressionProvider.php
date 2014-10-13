<?php
use ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\IExpressionProvider;

/**
 * Created by PhpStorm.
 * User: Balázs
 * Date: 2014.10.12.
 * Time: 23:25
 */

class FictiveCompanyExpressionProvider implements IExpressionProvider {
    const ADD = '+';
    const CLOSE_BRACKET = ')';
    const COMMA = ',';
    const DIVIDE = '/';
    const SUBTRACT = '-';
    const EQUAL = '=';
    const GREATERTHAN = '>';
    const GREATERTHAN_OR_EQUAL = '>=';
    const LESSTHAN = '<';
    const LESSTHAN_OR_EQUAL = '<=';
    const LOGICAL_AND = 'AND';
    const LOGICAL_NOT = '!';
    const LOGICAL_OR = 'OR';
    const MEMBERACCESS = '';
    const MODULO = '%';
    const MULTIPLY = '*';
    const NEGATE = '-';
    const NOTEQUAL = '!=';
    const OPEN_BRAKET = '(';

    /**
     * Get the name of the iterator
     *
     * @return string
     */
    public function getIteratorName()
    {
        // TODO: Implement getIteratorName() method.
    }

    /**
     * call-back for setting the resource type.
     *
     * @param \ODataProducer\Providers\Metadata\ResourceType $resourceType The resource type on which the filter
     *                                   is going to be applied.
     *
     * @return void
     */
    public function setResourceType(\ODataProducer\Providers\Metadata\ResourceType $resourceType)
    {
        // TODO: Implement setResourceType() method.
    }

    /**
     * Call-back for logical expression
     *
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\ExpressionType $expressionType The type of logical expression
     * @param string $left The left expression
     * @param string $right The left expression
     *
     * @return string
     */
    public function onLogicalExpression($expressionType, $left, $right)
    {
        // TODO: Implement onLogicalExpression() method.
    }

    /**
     * Call-back for arithmetic expression
     *
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\ExpressionType $expressionType The type of arithmetic expression
     * @param string $left The left expression
     * @param string $right The left expression
     *
     * @return string
     */
    public function onArithmeticExpression($expressionType, $left, $right)
    {
        // TODO: Implement onArithmeticExpression() method.
    }

    /**
     * Call-back for relational expression
     *
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\ExpressionType $expressionType The type of relation expression
     * @param string $left The left expression
     * @param string $right The left expression
     *
     * @return string
     */
    public function onRelationalExpression($expressionType, $left, $right)
    {
        // TODO: Implement onRelationalExpression() method.
    }

    /**
     * Call-back for unary expression
     *
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\ExpressionType $expressionType The type of unary expression
     * @param string $child The child expression
     *
     * @return string
     */
    public function onUnaryExpression($expressionType, $child)
    {
        // TODO: Implement onUnaryExpression() method.
    }

    /**
     * Call-back for constant expression
     *
     * @param \ODataProducer\Providers\Metadata\Type\IType $type The type of constant
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\objetc $value The value of the constant
     *
     * @return string
     */
    public function onConstantExpression(\ODataProducer\Providers\Metadata\Type\IType $type, $value)
    {
        // TODO: Implement onConstantExpression() method.
    }

    /**
     * Call-back for property access expression
     *
     * @param \ODataProducer\UriProcessor\QueryProcessor\ExpressionParser\PropertyAccessExpression $expression The property access expression
     *
     * @return string
     */
    public function onPropertyAccessExpression($expression)
    {
        // TODO: Implement onPropertyAccessExpression() method.
    }

    /**
     * Call-back for function call expression
     *
     * @param string $functionDescription Description of the function.
     * @param array <string> $params              Arguments to the functions.
     *
     * @return string
     */
    public function onFunctionCallExpression($functionDescription, $params)
    {
        // TODO: Implement onFunctionCallExpression() method.
    }
}


?>