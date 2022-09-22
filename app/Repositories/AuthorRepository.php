<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Repository;
use Log;

class AuthorRepository extends Repository
{
	public function __construct(Author $model)
	{
		$this->model=$model;
	}
	
	public function paginate() 
	{ 
		return $this->model
			->select('id', 'name')
			->orderByDesc('updated_at')
			->withCount('books')
			->paginate();
	}

	public function create(array $data)
	{
		return $this->model->create($data); 
	}

	public function update(string $id, array $data)
	{
		return $this->model->where([
			'id'=>$id
		])->update($data); 
	}

	public function delete(string $id)
	{
		return $this->model->where([
			'id'=>$id
		])->delete($id); 
	}

}
