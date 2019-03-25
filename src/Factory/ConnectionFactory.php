<?php

namespace Acme\Factory;

use Acme\DependencyInjection\DatabaseConfiguration;
use Acme\DependencyInjection\DatabaseConnection;

class ConnectionFactory
{	
	public static function getDocumentConnection()
	{	
		$file = realpath("../config/localhost.ini");

		if (!file_exists($file)) {
    		throw new \RuntimeException('Configuration not found file.');
		}	

		$host = parse_ini_file($file, true);
		$config = new DatabaseConfiguration(
			$host['db']['driver'], 
			$host['db']['host'], 
			$host['db']['port'], 
			$host['db']['dbname'],
			$host['db']['username'],
			$host['db']['password']
		);

		return (new DatabaseConnection($config))->getDocumentManager();
	}
} 
