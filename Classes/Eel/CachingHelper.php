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
     * @param array $entities
     * @param string $prefix
     * @return array
     * @throws Exception
     */
    public function entityTags(array $entities, $prefix)
    {
        $entryTags = array();
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
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
