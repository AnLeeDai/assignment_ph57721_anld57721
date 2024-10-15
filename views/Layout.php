<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<header>
    <nav>
        <a href="?route=news">Trang chủ</a>
        <a href="?route=manage-news">Quản lý tin tức</a>
        <a href="?route=manage-category">Quản lý danh mục</a>
        <a href="?route=logout">Đăng xuất</a>
    </nav>
</header>

<main>
    <?php
    if (isset($view)) {
        require_once PATH_VIEWS . $view . '.php';
    }
    ?>
</main>

<footer>
    <p>assignment_ph57721_anld57721</p>
</footer>

</body>
</html>
