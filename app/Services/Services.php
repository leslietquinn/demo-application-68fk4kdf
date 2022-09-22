<?php

namespace App\Services;

use App\Interfaces\ServicesInterface;
use App\Interfaces\RepositoriesInterface;
use Illuminate\Support\Facades\DB;

abstract class Services implements ServicesInterface
{
	protected $repository;

	public function __construct() {}
	
	/**
	 * Facilitate access to the repository, to a controller if need be
	 * 
	 * @return RepositoriesInterface
	 */
	
	public function getRepository() : RepositoriesInterface
	{
		return $this->repository;
	}

	/**
	 * Return a limited number of records ordered by creation date, descending
	 * 
	 * @return Collection
	 */

	public function paginate()
	{
		return $this->repository->paginate();
	}

	public function delete(string $id)
	{
		if(!$this->repository->findOne($id))
		{
			throw new ServiceFaultException('Data does not exist');
		}

		try
        {
			DB::beginTransaction();

			$this->repository->delete($id);

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
