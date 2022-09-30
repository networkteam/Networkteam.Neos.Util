<?php

namespace Networkteam\Neos\Util\Eel;

use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Neos\Exception;

/**
 * Caching helper for cache tag generation
 */
class CachingHelper implements ProtectedContextAwareInterface
{
    /**
     * @Flow\Inject
     * @var \Neos\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * Get entry tags for an array of entities
     *
     * @return string[]
     * @throws Exception
     */
    public function entityTags(array $entities, string $prefix): array
    {
        $entryTags = [];
        foreach ($entities as $entity) {
            $identifier = $this->persistenceManager->getIdentifierByObject($entity);
            if ($identifier !== null) {
                $entryTags[] = $prefix . '_' . $identifier;
            }
        }
        return $entryTags;
    }

    /**
     * All methods are considered safe
     *
     * @param string $methodName
     */
    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
