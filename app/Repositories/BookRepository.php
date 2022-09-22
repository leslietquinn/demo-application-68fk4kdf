<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Repository;
use Log;

class BookRepository extends Repository
{
	public function __construct(Book $model)
	{
		$this->model=$model;
	}
	
	public function paginate()
	{
		return $this->model
			->with('author') 
			->select('id', 'name', 'author_id')
			->orderByDesc('updated_at')
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
