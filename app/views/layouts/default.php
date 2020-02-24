<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styles.css">

    <?php \fw\core\base\View::getMeta() ?>

</head>
<body>
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/page/about/">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/admin/">Админка</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/signup">Регистрация</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/login">Вход</a></li>
        <li class="nav-item"><a class="nav-link" href="/user/login">Выход</a></li>
    </ul>
    <?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; unset($_SESSION['error']) ?>
    </div>
    <?php endif;?>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']) ?>
        </div>
    <?php endif;?>

<?= $content ?>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<?php foreach ($scripts as $script) {
    echo $script;
} ?>
</body>
</html>
