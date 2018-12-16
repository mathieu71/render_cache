<?php
namespace Drupal\render_cache;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Modifies the core render_cache service.
 */
class RenderCacheServiceProvider extends ServiceProviderBase
{

    /**
     *
     * {@inheritdoc}
     */
    public function alter(ContainerBuilder $container)
    {
        try {
            $definition = $container->getDefinition('render_cache');
        } catch (ServiceNotFoundException $e) {
            return;
        }
        $definition->setClass('Drupal\render_cache\PlaceholderingRenderCache');

        try {
            $definition = $container->getDefinition('http_middleware.page_cache');
        } catch (ServiceNotFoundException $e) {
            return;
        }
        $definition->setClass('Drupal\render_cache\StackMiddleware\PageCache');
    }
}