<?php

namespace Networkteam\Neos\Util\Eel\FlowQueryOperations;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Eel\FlowQuery\Operations\AbstractOperation;
use Neos\Flow\Annotations as Flow;
use Neos\ContentRepository\Domain\Model\NodeInterface;

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
    static protected $shortName = 'mapProperty';

    /**
     * {@inheritdoc}
     *
     * @var boolean
     */
    static protected $final = TRUE;

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
            return TRUE;
        }
        $firstElement = reset($context);
        return $firstElement === NULL || $firstElement instanceof NodeInterface;
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
            throw new \Neos\Eel\FlowQuery\FlowQueryException('mapProperty() does not support returning all attributes', 1429712387);
        } else {
            $context = $flowQuery->getContext();
            $propertyPath = $arguments[0];

            $result = [];
            foreach ($context as $element) {
                if ($element instanceof NodeInterface) {
                    if ($propertyPath[0] === '_') {
                        $result[] = \Neos\Utility\ObjectAccess::getPropertyPath($element, substr((string)$propertyPath, 1));
                    } else {
                        $result[] = $element->getProperty($propertyPath);
                    }
                }
            }
            return $result;
        }
    }
}
