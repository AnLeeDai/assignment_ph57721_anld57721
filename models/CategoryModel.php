<?php

namespace models;

class CategoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'categories';
    }

    public function addCategory($data): false|string
    {
        return $this->insert($data);
    }


    public function getAllCategory(): false|array
    {
        return $this->select();
    }

    public function getCategoryById($id): false|array
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->find('*', $conditions, $params);
    }

    public function updateCategory($data, $id): int
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->update($data, $conditions, $params);
    }

    public function deleteCategory($id): int
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->delete($conditions, $params);
    }
}