<?php

namespace Acme\DependencyInjection;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

class DatabaseConnection
{
    /**
     * @var DatabaseConfiguration
     */
    private $configuration;

    /**
     * @param DatabaseConfiguration $config
     */
    public function __construct(DatabaseConfiguration $config)
    {
        $this->configuration = $config;
    }

    public function getDocumentManager(): DocumentManager
    {
        $db = sprintf("%s://%s:%s", 
            $this->configuration->getDriver(), 
            $this->configuration->getHost(),
            $this->configuration->getPort()
        );

        $dir_documents = realpath("../src/Documents/");

        if (!is_dir($dir_documents)) {
            throw new \RuntimeException('Documents not found dir.');
        }

        $connection = new Connection($db);
        $config = new Configuration();

        $config->setProxyDir('../src/generate/proxies');
        $config->setProxyNamespace('Proxies');
        $config->setHydratorDir('../src/generate/hydrators');
        $config->setHydratorNamespace('Hydrators');
        $config->setDefaultDB($this->configuration->getDataBaseName());
        $config->setMetadataDriverImpl(AnnotationDriver::create($dir_documents));

        AnnotationDriver::registerAnnotationClasses();
        $dm = DocumentManager::create($connection, $config);

        return $dm;
    }
}