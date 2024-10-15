<?php

namespace controllers;

use JetBrains\PhpStorm\NoReturn;
use models\CategoryModel;

class CategoryController extends CategoryModel
{
    public function __construct()
    {
        parent::__construct();

        if (empty($_SESSION['user'])) {
            header('Location: index.php');
            exit;
        }

        if (isset($_GET['form_delete_category'])) {
            $this->remove();
        }
    }

    public function manage(): void
    {
        $view = 'ManageCategory';
        $listCategories = $this->getAllCategory();
        $_SESSION['$listCategoriesSession'] = $listCategories;
        require_once PATH_VIEWS_LAYOUT;
    }

    public function add(): void
    {
        $view = 'AddCategory';
        require_once PATH_VIEWS_LAYOUT;

        if (isset($_POST['form_add_category'])) {

            $name = $_POST['name'];
            $description = $_POST['description'];

            if (empty($name) || empty($description)) {
                return;
            }

            $data = [
                'name' => $name,
                'description' => $description
            ];

            $this->addCategory($data);
            header('Location: ?route=manage-category');
            exit;
        }
    }

    #[NoReturn] public function remove(): void
    {
        $id = $_GET['id'];
        $this->deleteCategory($id);
        header('Location: ?route=manage-category');
        exit;
    }

    public function getById(): false|array
    {
        $id = $_GET['id'];
        return $this->getCategoryById($id);
    }

    public function edit(): void
    {
        $listPreviousData = $this->getById();
        $view = 'EditCategory';
        require_once PATH_VIEWS_LAYOUT;


        if (isset($_POST['form_edit_category'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];

            if (empty($name) || empty($description)) {
                return;
            }

            $data = [
                'name' => $name,
                'description' => $description
            ];

            $this->updateCategory($data, $id);
            header('Location: ?route=manage-category');
            exit;
        }
    }
}