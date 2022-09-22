<?php

namespace App\Services;

use App\Services\Services;
use App\Repositories\AuthorRepository;
use App\Exceptions\ServiceFaultException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Log;

class AuthorService extends Services
{
	public function __construct(AuthorRepository $repository)
	{
		$this->repository=$repository;
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
