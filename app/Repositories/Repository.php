<?php

namespace App\Repositories;

use App\Models\Author;
use App\Interfaces\RepositoriesInterface;

abstract class Repository implements RepositoriesInterface
{
	protected $model;

	public function __construct() {}
	
	abstract public function paginate();
	abstract public function create(array $data);
	abstract public function update(string $id, array $data);
	abstract public function delete(string $id);
	
	public function findAll()
	{
		return $this->model->get();
	}

	public function findOne(string $id)
	{
		return $this->model->where([
			'id'=>$id
		])->first();
	}

	public function findWhere(array $conditions)
	{
		return $this->model->where($conditions)->get();
	}
	
}
