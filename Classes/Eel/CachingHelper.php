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
        if (!is_array($entities) && !$entities instanceof \Traversable) {
            throw new Exception(sprintf('FlowQuery result, Array or Traversable expected by this helper, given: "%s".', gettype($entities)), 1501252625);
        }

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
     * @param string $className Fully qualified class name of entity, i.e. "AcmeCom\SomePackage\Domain\Model\Foobar"
     * @return string
     */
    public static function entityTypeTag(string $className)
    {
        return 'EntityType_' . strtr($className, "\\", '_');
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
