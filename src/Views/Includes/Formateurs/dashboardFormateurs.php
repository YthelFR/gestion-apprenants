<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Document</title>
</head>

<?php include __DIR__ . '/../header.php'; ?>

<body>
    <?php include __DIR__ . '/../../navtab.php';
    include __DIR__ . '/promotion.php';
    include __DIR__ . '/allpromotions.php';
    include __DIR__ . '/createPromotion.php';
    include __DIR__ . '/editPromotion.php';
    ?>
</body>