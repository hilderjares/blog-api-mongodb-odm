<?php

namespace Acme\DependencyInjection;

class DatabaseConfiguration
{
    /**
     * @var string
     */
    private $driver;
    /**
     * @var string
     */
    private $host;
    /**
     * @var int
     */
    private $port;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $dbname;
    /**
     * @var string
     */
    private $password;

    public function __construct(
		string $driver, 
		string $host, 
		int $port, 
		string $dbname, 
		string $username, 
		string $password
    ) {	
    	$this->driver = $driver;
        $this->host = $host;
        $this->port = $port;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function getDriver(): string
    {
    	return $this->driver;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getDataBaseName(): string
    {
    	return $this->dbname;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
