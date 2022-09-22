<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

use App\Services\Services;
use App\Repositories\BookRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Exceptions\ServiceFaultException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Log;

class BookService extends Services
{
	public function __construct(BookRepository $repository)
	{
		$this->repository=$repository;
	}

	/**
	 * Facilitate access to the Author repository
	 * 
	 */

	public function getAuthors()
	{
		return (new AuthorRepository(new Author()))->findAll();
	}

	/**
	 * Facilitate access to the Category repository
	 * 
	 */

	public function getCategories()
	{
		return (new CategoryRepository(new Category()))->findAll();
	}
	
	/**
	 * Validate data and if okay, proceed to create a new row of data
	 * 
	 * @param array $data
	 * @return mixed
	 * @throws ServiceFaultException
	 */

	public function create(array $data)
	{
		$validator = Validator::make($data, [
            'name'=>['required', 'string', 'max:64']
          , 'author_id'=>['required', 'string']
          , 'category_id'=>['required', 'string']
        ]);

        if($validator->fails())
        {
        	return $validator->messages()->get('*');
        }

        try
        {
			DB::beginTransaction();

			$this->repository->create($data);

			DB::commit();        
        }
        catch(Throwable $e)
        {
        	DB::rollback();

        	throw new ServiceFaultException($e->getMessage());
        }

        return true;
	}

	/**
	 * Validate data and if okay, proceed to update an existing row of data
	 * 
	 * @param string $id
	 * @param array $data
	 * @return mixed
	 * @throws ServiceFaultException
	 */

	public function update(string $id, array $data)
	{
		$validator = Validator::make($data, [
            'id'=>['required', 'string']
          , 'name'=>['required', 'string', 'max:64']
          , 'author_id'=>['required', 'string']
          , 'category_id'=>['required', 'string']
        ]);

        if($validator->fails())
        {
        	return $validator->messages()->get('*');
        }

        try
        {
			DB::beginTransaction();

			$this->repository->update($id, $data);

			DB::commit();        
        }
        catch(Throwable $e)
        {
        	DB::rollback();

        	throw new ServiceFaultException($e->getMessage());
        }

        return true;
	}
}
