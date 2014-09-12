<?php
namespace CKEditorModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ConfigServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        return array_key_exists('ckeditor_module', $config) ? $config['ckeditor_module'] : array();
    }
}
