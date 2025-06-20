
<?php

include 'connect.php';

$picture = $_FILES['pphoto']['name'];
$tmp_path = $_FILES['pphoto']['tmp_name'];
$upload_dir = 'img/';
$target = $upload_dir . basename($picture);

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
move_uploaded_file($tmp_path, $target);

$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$category = $_POST['category'];
$archive = isset($_POST['archive']) ? 1 : 0;
$date = $_POST['datum'];


$query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'ssssssi', $date, $title, $about, $content, $picture, $category, $archive);
mysqli_stmt_execute($stmt);

mysqli_close($dbc);

header("Location: index.php");
exit;
?>
