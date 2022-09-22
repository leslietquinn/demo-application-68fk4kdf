<?php

namespace App\Interfaces;

interface ServicesInterface
{
	public function paginate();
	public function create(array $data);
	public function update(string $id, array $data);
	public function delete(string $id);
	
}
