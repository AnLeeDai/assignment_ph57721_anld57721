<form method="post" id="login-form" style="background: none; box-shadow: none">
    <h2>Sửa danh mục</h2>

    <label for="name">Tên</label>
    <input type="text" name="name" id="name" placeholder="Tên danh mục"
           value="<?= $listPreviousData['name'] ?>"
    >

    <label for="description">Mô tả</label>
    <input type="text" name="description" id="description" placeholder="Mô tả danh mục"
           value="<?= $listPreviousData['description'] ?>"
    >

    <button type="submit" name="form_edit_category">Sửa danh mục</button>
</form>