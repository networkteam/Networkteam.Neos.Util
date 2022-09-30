<?php
namespace Networkteam\Neos\Util;

use Neos\Flow\Core\Bootstrap;
use Neos\Flow\Package\Package as BasePackage;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Fusion\Core\Cache\ContentCache;
use Neos\Media\Domain\Model\AssetInterface;
use Neos\Media\Domain\Service\AssetService;

class Package extends BasePackage
{
    /**
     * Invokes custom PHP code directly after the package manager has been initialized.
     *
     * @param Bootstrap $bootstrap The current bootstrap
     */
    public function boot(Bootstrap $bootstrap): void
    {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();

        // Flush content cache tag "Asset_[identifier]" on Asset update
        $dispatcher->connect(AssetService::class, 'assetUpdated', function(AssetInterface $asset) use ($bootstrap): void {
            $objectManager = $bootstrap->getObjectManager();
            $contentCache = $objectManager->get(ContentCache::class);
            $persistenceManager = $objectManager->get(PersistenceManagerInterface::class);
            $contentCache->flushByTag('Asset_' . $persistenceManager->getIdentifierByObject($asset));
        });
    }
}
