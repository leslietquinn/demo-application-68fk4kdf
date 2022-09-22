<?php

namespace App\Interfaces;

interface RepositoriesInterface
{
	public function findAll();
	public function findOne(string $id);
	public function findWhere(array $conditions);
	public function paginate();
	
}
