<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="fckout.css">
</head>

<body>
    <?php
    include 'components/navbar.php';
    ?>
    <?= toast('success') ?>
    {{content}}
</body>

</html>
