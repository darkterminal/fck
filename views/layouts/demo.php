<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css" integrity="sha256-GxX+KXGZigSK67YPJvbu12EiBx257zuZWr0AMiT1Kpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="fckout.css">
</head>

<body>
    <?php
    include 'components/navbar.php';
    ?>
    <div class="w-9/12 p-3 mx-auto prose md:prose-lg lg:prose-xl">
        <?= toast('success') ?>
        {{content}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/autoloader/prism-autoloader.min.js" integrity="sha256-AjM0J5XIbiB590BrznLEgZGLnOQWrt62s3BEq65Q/I0=" crossorigin="anonymous"></script>
</body>

</html>
