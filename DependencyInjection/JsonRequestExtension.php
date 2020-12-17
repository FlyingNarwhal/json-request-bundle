<?php

namespace SymfonyBundles\JsonRequestBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class JsonRequestExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $listener = new Definition($configs['listener']['request_transformer']);

        $listener->addTag('kernel.event_listener', [
            'event' => 'kernel.request',
            'method' => 'onKernelRequest',
            'priority' => $configs['listener']['priority'],
        ]);

        $container->setDefinition('sb_json_request.request_transformer', $listener);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_json_request';
    }
}
