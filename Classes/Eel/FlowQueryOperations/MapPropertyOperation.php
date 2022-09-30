<?php

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

namespace Networkteam\Neos\Util\Eel\FlowQueryOperations;

use Neos\ContentRepository\Core\Projection\ContentGraph\Node;
use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Eel\FlowQuery\FlowQueryException;
use Neos\Eel\FlowQuery\Operations\AbstractOperation;
use Neos\Flow\Annotations as Flow;
use Neos\Utility\ObjectAccess;

/**
 * Retrieve a property of all results in the context and map it to an array
 */
class MapPropertyOperation extends AbstractOperation
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $shortName = 'mapProperty';

    /**
     * {@inheritdoc}
     *
     * @var boolean
     */
    protected static $final = true;

    /**
     * {@inheritdoc}
     *
     * We can only handle TYPO3CR Nodes (but also an empty context)
     *
     * @param mixed $context
     */
    public function canEvaluate($context): bool
    {
        if (empty($context)) {
            return true;
        }
        $firstElement = reset($context);
        return $firstElement === null || $firstElement instanceof Node;
    }

    /**
     * {@inheritdoc}
     *
     * @param FlowQuery $flowQuery the FlowQuery object
     * @param array $arguments the arguments for this operation
     * @return mixed
     */
    public function evaluate(FlowQuery $flowQuery, array $arguments)
    {
        if (!isset($arguments[0]) || empty($arguments[0])) {
            throw new FlowQueryException('mapProperty() does not support returning all attributes', 1429712387);
        } else {
            $context = $flowQuery->getContext();
            $propertyPath = $arguments[0];

            $result = [];
            foreach ($context as $element) {
                if ($element instanceof Node) {
                    if ($propertyPath[0] === '_') {
                        $result[] = ObjectAccess::getPropertyPath($element, substr((string)$propertyPath, 1));
                    } else {
                        $result[] = $element->getProperty($propertyPath);
                    }
                }
            }
            return $result;
        }
    }
}
