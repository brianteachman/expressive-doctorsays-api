<?php

namespace Api;

/**
 * The configuration provider for the Api module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
	            Api\Action\TheDoctorSaysAction::class => Api\Action\TheDoctorSaysAction::class,
            ],
            'factories'  => [
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'api'    => [__DIR__ . '/../templates/api'],
//                'error'  => [__DIR__ . '/../templates/error'],
//                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
