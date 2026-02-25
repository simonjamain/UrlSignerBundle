<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use CoopTilleuls\UrlSignerBundle\UrlSigner\Md5UrlSigner;
use CoopTilleuls\UrlSignerBundle\UrlSigner\Sha256UrlSigner;
use CoopTilleuls\UrlSignerBundle\EventListener\ValidateSignedRouteListener;

return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $parameters = $container->parameters();

    $services->set('url_signer.signer.md5', Md5UrlSigner::class)
        ->public()
        ->tag('url_signer.signer');

    $services->alias(Md5UrlSigner::class, 'url_signer.signer.md5');

    $services->set('url_signer.signer.sha256', Sha256UrlSigner::class)
        ->public()
        ->tag('url_signer.signer');

    $services->alias(Sha256UrlSigner::class, 'url_signer.signer.sha256');
 
    $services->set('url_signer.listener.validate_signed_route', ValidateSignedRouteListener::class)
        ->private()
        ->args([service('url_signer.signer')])
        ->tag('kernel.event_subscriber');
};
