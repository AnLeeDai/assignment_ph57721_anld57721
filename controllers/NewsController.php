<?php

namespace controllers;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use models\CategoryModel;
use models\NewsModel;

class NewsController extends NewsModel
{

    private CategoryModel $categoryModel;

    public function __construct()
    {
        parent::__construct();

        $this->categoryModel = new CategoryModel();

        if (empty($_SESSION['user'])) {
            header('Location: index.php');
            exit;
        }

        if (isset($_GET['form_delete_news'])) {
            $this->removeNews();
        }
    }

    public function news(): void
    {
        $listNews = $this->getAllNewsWithCategory();

        $view = 'News';
        require_once PATH_VIEWS_LAYOUT;
    }

    public function manageNews(): void
    {
        $listNews = $this->getAllNewsWithCategory();
        $view = 'ManageNews';
        require_once PATH_VIEWS_LAYOUT;
    }

    public function getById(): false|array
    {
        $id = $_GET['id'];
        return $this->getNewsById($id);
    }

    public function edit(): void
    {
        $listCategories = $this->categoryModel->getAllCategory();
        $listPreviousData = $this->getById();
        $view = 'EditNews';
        require_once PATH_VIEWS_LAYOUT;

        if (isset($_POST['form_edit_news'])) {
            $id = $_GET['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            try {
                $image = $_FILES['image'];

                if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                    $imagePath = $this->getStr($image);

                } else {
                    $imagePath = $listPreviousData['image'];
                }

                $data = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'image' => basename($imagePath),
                    'category_id' => $category_id
                ];

                $this->updateNews($data, $id);
                header('Location: ?route=manage-news');
                exit;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    #[NoReturn] public function removeNews(): void
    {
        $id = $_GET['id'];
        $this->deleteNews($id);
        header('Location: ?route=manage-news');
        exit;
    }

    public function add(): void
    {
        $listCategories = $this->categoryModel->getAllCategory();
        $view = 'AddNews';
        require_once PATH_VIEWS_LAYOUT;

        if (isset($_POST['form_add_news'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            try {
                $image = $_FILES['image'];

                if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                    $imagePath = $this->getStr($image);

                } else {
                    throw new Exception('Hình ảnh không hợp lệ hoặc không được tải lên.');
                }

                $data = [
                    'title' => $title,
                    'description' => $description,
                    'image' => basename($imagePath),
                    'category_id' => $category_id
                ];

                $this->addNews($data);
                header('Location: ?route=manage-news');
                exit;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    /**
     * @param mixed $image
     * @return string
     * @throws Exception
     */
    public function getStr(mixed $image): string
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            throw new Exception('Định dạng file không hợp lệ.');
        }

        if ($image['size'] > 5 * 1024 * 1024) {
            throw new Exception('Kích thước file quá lớn.');
        }

        $newFileName = uniqid() . '.' . $fileExtension;

        $uploadDir = ASSETS_UPLOAD_PATH;
        $uploadFile = $uploadDir . $newFileName;

        if (!move_uploaded_file($image['tmp_name'], $uploadFile)) {
            throw new Exception('Lỗi trong quá trình di chuyển file.');
        }

        return $uploadFile;
    }
}