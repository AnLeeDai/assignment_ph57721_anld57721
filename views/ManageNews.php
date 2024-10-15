<div class="container">
    <a href="?route=add-news">
        <button class="add-btn">Thêm tin tức</button>
    </a>

    <table>
        <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Thời gian tạo</th>
            <th>Hành động</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($listNews as $index => $item) { ?>
            <tr>
                <td>
                    <?= $item['title'] ?>
                </td>

                <td>
                    <image src="<?= ASSETS_UPLOAD_PATH ?><?= $item['image'] ?>" alt="News Image"
                           style="width: 100px; height: 100px">
                </td>

                <td>
                    <?= $item['description'] ?>
                </td>

                <td style="width: 12%;">
                    <time>
                        <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                    </time>
                </td>

                <td style="width: 12%;">
                    <a href="?route=edit-news&id=<?= $item['id'] ?>">
                        <button class="edit-btn">Edit</button>
                    </a>

                    <form method="get" style="display: inline;">
                        <input type="hidden" name="route" value="manage-news">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button class="delete-btn" name="form_delete_news">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </table>
</div>