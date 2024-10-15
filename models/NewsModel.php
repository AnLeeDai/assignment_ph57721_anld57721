<?php

namespace models;

class NewsModel extends BaseModel
{
    protected $table = 'news';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllNewsWithCategory(): array
    {
        $columns = 'news.*, categories.name AS category_name';

        $joins = [
            [
                'type' => 'INNER',
                'table' => 'categories',
                'on' => 'news.category_id = categories.id'
            ]
        ];

        return $this->selectWithJoin($columns, $joins);
    }

    public function addNews($data): false|string
    {
        return $this->insert($data);
    }

    public function getNewsById($id): false|array
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->find('*', $conditions, $params);
    }


    public function updateNews($data, $id): int
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->update($data, $conditions, $params);
    }

    public function deleteNews($id): false|string
    {
        $conditions = "id = :id";
        $params = [':id' => $id];

        return $this->delete($conditions, $params);
    }
}