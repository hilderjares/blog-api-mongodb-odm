<?php

namespace Acme\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Acme\Documents\BlogPost;
use Doctrine\Common\Collections\ArrayCollection;

/** @ODM\Document */
class User
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;

    /** @ODM\Field(type="string") */
    private $email;

    /** @ODM\ReferenceMany(targetDocument="BlogPost", cascade="all") */
    private $posts;

    function __construct() 
    { 
        $this->posts = new ArrayCollection(); 
    }

    public function getId(): String
    {
    	return $this->id;
    }

    public function getName(): String
    {
    	return $this->name;
    }

    public function setName(String $name)
    {
    	$this->name = $name;
    }

    public function getEmail(): string
    {
    	return $this->email;
    }

    public function setEmail(String $email)
    {
    	$this->email = $email;
    }

    public function getPosts(): Object
    {
    	return $this->posts;
    }

    public function addPost(BlogPost $post)
    {
    	$this->posts[] = $post;
    }
}