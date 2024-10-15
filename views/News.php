<div class="container">
    <div class="grid">
        <?php
        if (empty($listNews)) {
            echo 'Không có tin tức nào';
        }

        foreach ($listNews as $index => $item) { ?>
            <div class="card">
                <img src="<?= ASSETS_UPLOAD_PATH ?><?= $item['image'] ?>" alt="News Image">

                <div class="card-content">
                    <h2><?= $item['title'] ?></h2>

                    <time>
                        <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                    </time>

                    <p>
                        <?= $item['description'] ?>
                    </p>

                    <div class="category">
                        <span><?= $item['category_name'] ?></span>
                    </div>
                </div>
            </div>
            <?php
        } ?>
    </div>
</div>
