<?php

namespace Lentech\Botster\Factory;

use Lentech\Botster\Interactor as Interactors;

class Interactor
{
	private $dbh;
	
	public function __construct(\PDO $dbh)
	{
		$this->dbh = $dbh;
	}
	
	public function makeStartConversation()
	{
		$repository_factory = new Repository($this->dbh);
		
		return new Interactors\StartConversation(
			$repository_factory->makeConversation()
		);
	}
	
	public function makeSayMessage()
	{
		$repository_factory = new Repository($this->dbh);
		
		return new Interactors\SayMessage(
			$repository_factory->makeMessage()
		);
	}
	
	public function makeLetRespond()
	{
		$repository_factory = new Repository($this->dbh);
		
		return new Interactors\LetRespond(
			$repository_factory->makeUtterance(),
			$repository_factory->makeConnection(),
			$repository_factory->makeWord(),
			$repository_factory->makeMessage(),
			$repository_factory->makeLog()
		);
	}
}