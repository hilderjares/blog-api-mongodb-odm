<?php

namespace Acme\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/** @ODM\Document */
class BlogPost
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="string") */
    private $body;

    /** @ODM\Field(type="date") */
    private $createdAt;

	public function getId(): string
    {
    	return $this->id;
    }

    public function getTitle(): string
    {
    	return $this->title;
    }  

    public function setTitle(string $title)
    {
    	$this->title = $title;
    }

    public function getBody(): string
    {
    	return $this->body;
    }

    public function setBody(string $body)
    {
    	$this->body = $body;
    }

    public function getCreatedAt(): DateTime
    {
    	return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
    	$this->createdAt = $createdAt;
    }
}