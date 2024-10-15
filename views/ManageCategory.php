<div class="container">
    <a href="?route=add-category">
        <button class="add-btn">Thêm danh mục</button>
    </a>

    <table>
        <thead>
        <tr>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Thời gian tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($listCategories as $index => $item) { ?>
            <tr>
                <td>
                    <?= $item['name'] ?>
                </td>
                <td>
                    <?= $item['description'] ?>
                </td>
                <td>
                    <time>
                        <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                    </time>
                </td>


                <td>
                    <a href="?route=edit-category&id=<?= $item['id'] ?>">
                        <button class="edit-btn">Edit</button>
                    </a>

                    <form method="get" style="display: inline;">
                        <input type="hidden" name="route" value="manage-category">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button class="delete-btn" name="form_delete_category">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>