<?php

namespace Acme\Repository;

use Acme\Documents\User;
use Acme\Factory\ConnectionFactory;
use Acme\Factory\DocumentFactory;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\DocumentManager;

class UserRepository extends DocumentRepository
{   
    function __construct()
    {   
        $documentManager = ConnectionFactory::getDocumentConnection();
        parent::__construct(
            $documentManager,
            $documentManager->getUnitOfWork(),
            $documentManager->getClassMetadata(User::class)
        );
    }
	
    public function save(User $user)
    {
        $this->dm->persist($user);
        $this->dm->flush();
    }

    public function remove(User $user)
    {
        $this->dm->remove($user);
        $this->dm->flush();
    }

    public function findById(string $id)
    {
        return $this->dm->find(User::class, $id);
    }

    public function findAll()
    {
        $queryBuilder = $this->createQueryBuilder('User')->limit(10)->hydrate(true);
        $query = $queryBuilder->getQuery();
        return $query->execute();
    }
}