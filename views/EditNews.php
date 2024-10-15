<form method="post" id="login-form" style="background: none; box-shadow: none" enctype="multipart/form-data">
    <h2>Sửa tin tức</h2>

    <label for="title">Tiêu đề</label>
    <input type="text" name="title" id="title" placeholder="Tiêu đề bài viết"
           value="<?= $listPreviousData['title'] ?>"
    >

    <label for="image">Ảnh</label>
    <?php if (!empty($listPreviousData['image'])) { ?>
        <img src="<?= ASSETS_UPLOAD_PATH ?><?= $listPreviousData['image'] ?>" alt="Ảnh hiện tại"
             style="max-width: 200px; display: block; margin-bottom: 10px;">
    <?php } ?>
    <input type="file" accept="image/*" name="image" id="image">

    <label for="description">Mô tả</label>
    <input type="text" name="description" id="description" placeholder="Mô tả bài viết"
           value="<?= $listPreviousData['description'] ?>"
    >

    <label for="category_id">Danh mục</label>
    <select name="category_id" id="category_id"
            style="padding: 10px; margin-bottom: 20px; width: 100%; border-radius: 5px; border: 1px solid #ccc"
    >
        <?php foreach ($listCategories as $index => $item) { ?>
            <option value="<?= $item['id'] ?>" <?= $item['id'] == $listPreviousData['category_id'] ? 'selected' : '' ?>>
                <?= $item['name'] ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit" name="form_edit_news">Sửa tin tức</button>
</form>
