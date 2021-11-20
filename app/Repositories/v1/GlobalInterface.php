<?php

namespace App\Repositories\v1;

interface GlobalInterface
{
    public function all();

    public function create($data);

    public function update($data, $id);

    public function delete($id);

    public function find($id);
}