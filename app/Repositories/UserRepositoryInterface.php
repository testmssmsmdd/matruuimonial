<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAdminList($request);

    public function store($data);

    public function findById($id);

    public function update($id, $data);

    public function delete($id);

    public function updateStatus($id, $status);
}