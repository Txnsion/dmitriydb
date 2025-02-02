<?php
// Подключение к базе данных
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['pdf_file']['name']);
        $file_tmp = $_FILES['pdf_file']['tmp_name'];
        $upload_dir = 'uploads/';
        $file_path = $upload_dir . $file_name;

        // Перемещаем файл в папку uploads
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Сохраняем информацию о файле в базу данных
            $stmt = $pdo->prepare("INSERT INTO pdf_files (file_name, file_path) VALUES (:file_name, :file_path)");
            $stmt->execute([
                ':file_name' => $file_name,
                ':file_path' => $file_path
            ]);

            echo "Файл успешно загружен!";
        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "Ошибка: файл не был загружен.";
    }
}
?>