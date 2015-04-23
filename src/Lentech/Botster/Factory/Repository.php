<?php

namespace Lentech\Botster\Factory;

use Lentech\Botster\Repository as Repositories;
use Aura\SqlQuery\QueryFactory;

class Repository
{
	private $dbh;
	private $query_factory;
	
	public function __construct(\PDO $dbh)
	{
		$this->dbh = $dbh;
		$this->query_factory = new QueryFactory('mysql');
	}
	
	public function makeUtterance()
	{
		return new Repositories\Utterance($this->dbh, $this->query_factory);
	}
	
	public function makeConnection()
	{
		return new Repositories\Connection($this->dbh, $this->query_factory);
	}
	
	public function makeConversation()
	{
		return new Repositories\Conversation($this->dbh, $this->query_factory);
	}
	
	public function makeWord()
	{
		return new Repositories\Word($this->dbh, $this->query_factory);
	}
	
	public function makeMessage()
	{
		return new Repositories\Message($this->dbh, $this->query_factory);
	}
	
	public function makeLog()
	{
		return new Repositories\Log($this->dbh, $this->query_factory);
	}
}