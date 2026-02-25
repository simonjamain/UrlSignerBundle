<?php
 
namespace Symfony\Component\DependencyInjection\Loader\Configurator;
 
return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $parameters = $container->parameters();
 
    $services->set('url_signer.signer.md5', \CoopTilleuls\UrlSignerBundle\UrlSigner\Md5UrlSigner::class)
        ->public()
        ->tag('url_signer.signer');
 
    $services->alias(\CoopTilleuls\UrlSignerBundle\UrlSigner\Md5UrlSigner::class, 'url_signer.signer.md5');
 
    $services->set('url_signer.signer.sha256', \CoopTilleuls\UrlSignerBundle\UrlSigner\Sha256UrlSigner::class)
        ->public()
        ->tag('url_signer.signer');
 
    $services->alias(\CoopTilleuls\UrlSignerBundle\UrlSigner\Sha256UrlSigner::class, 'url_signer.signer.sha256');
 
    $services->set('url_signer.listener.validate_signed_route', \CoopTilleuls\UrlSignerBundle\EventListener\ValidateSignedRouteListener::class)
        ->private()
        ->args([service('url_signer.signer')])
        ->tag('kernel.event_subscriber');
};
