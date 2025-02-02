<?php
include 'database.php';

// Получаем список файлов из базы данных
$stmt = $pdo->query("SELECT * FROM pdf_files");
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр PDF</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Загруженные PDF-файлы</h1>
    <?php if (count($files) > 0): ?>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <a href="<?= $file['file_path'] ?>" target="_blank"><?= $file['file_name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Нет загруженных файлов.</p>
    <?php endif; ?>
    <a href="index.html">Вернуться к загрузке</a>
</div>
</body>
</html>