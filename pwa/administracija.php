<?php
session_start();
include 'connect.php';


if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
  header("Location: login.php");
  exit;
}


if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  mysqli_query($dbc, "DELETE FROM vijesti WHERE id=$id");
}


if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $about = $_POST['about'];
  $content = $_POST['content'];
  $category = $_POST['category'];
  $datum = $_POST['datum'];
  $archive = isset($_POST['archive']) ? 1 : 0;

  $query = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, datum=?, kategorija=?, arhiva=?";
  $params = [$title, $about, $content, $datum, $category, $archive];

  if (!empty($_FILES['pphoto']['name'])) {
    $picture = $_FILES['pphoto']['name'];
    move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/' . $picture);
    $query .= ", slika=?";
    $params[] = $picture;
  }

  $query .= " WHERE id=?";
  $params[] = $id;

  $stmt = mysqli_prepare($dbc, $query);
  $types = str_repeat('s', count($params) - 1) . 'i';
  mysqli_stmt_bind_param($stmt, $types, ...$params);
  mysqli_stmt_execute($stmt);
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Administracija vijesti</title>
  <style>
    *{ font-family: 'Georgia', serif;}
    body {
      font-family: 'Georgia', serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {

      padding: 20px;
      text-align: center;
    }
    header h1{
      color:#003b5c;
    }
    nav a {
      color: black;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    .logout {
      text-align: right;
      background: #eee;
      padding: 10px 20px;
      font-size: 14px;
    }
    main {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    form {
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
      margin-bottom: 30px;
    }
    input[type=text], input[type=date], textarea, select {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
    }
    input[type=file] {
      margin-bottom: 10px;
    }
    img {
      max-width: 200px;
      margin: 10px 0;
    }
    .actions {
      margin-top: 10px;
    }
    .actions button {
      padding: 8px 16px;
      margin-right: 10px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      background-color: #003366;
      color: white;
      border-radius: 4px;
    }
    .actions button[name=delete] {
      background-color: #c00;
    }
     footer {
      padding: 20px;
      text-align: center;
      border-top: 1px solid #ccc;
      font-size: 0.9em;
      background: rgb(236, 235, 235);
      margin-top:30px;
    }
    footer nav a {
      color: #555;
    }
  </style>
</head>
<body>

<header>
  <h1>El Confidencial</h1>
  <nav>
    <a href="index.php">HOME</a>
    <a href="kategorija.php?id=europa">EUROPA</a>
    <a href="kategorija.php?id=teknautas">TEKNAUTAS</a>
    <a href="unos.html">UNOS</a>
    <a href="logout.php">ODJAVA</a>
  </nav>
</header>

<div class="logout">
  Prijavljeni ste kao <strong><?php echo $_SESSION['username']; ?></strong>
</div>

<main>
  <h2>Administracija vijesti</h2>

  <?php
  define('UPLPATH', 'img/');
  $result = mysqli_query($dbc, "SELECT * FROM vijesti ORDER BY id DESC");

  while ($row = mysqli_fetch_array($result)) {
    echo '<form method="POST" enctype="multipart/form-data">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';

    echo '<label>Naslov:</label>';
    echo '<input type="text" name="title" value="' . htmlspecialchars($row['naslov']) . '">';

    echo '<label>Sažetak:</label>';
    echo '<textarea name="about">' . htmlspecialchars($row['sazetak']) . '</textarea>';

    echo '<label>Tekst:</label>';
    echo '<textarea name="content">' . htmlspecialchars($row['tekst']) . '</textarea>';

    echo '<label>Datum objave:</label>';
    echo '<input type="date" name="datum" value="' . htmlspecialchars($row['datum']) . '">';

    echo '<label>Trenutna slika:</label>';
    echo '<img src="' . UPLPATH . $row['slika'] . '" alt="slika">';

    echo '<label>Nova slika (opcionalno):</label>';
    echo '<input type="file" name="pphoto">';

    echo '<label>Kategorija:</label>';
    echo '<select name="category">';
    echo '<option value="europa"' . ($row['kategorija'] == 'europa' ? ' selected' : '') . '>Europa</option>';
    echo '<option value="teknautas"' . ($row['kategorija'] == 'teknautas' ? ' selected' : '') . '>Teknautas</option>';
    echo '</select>';

    echo '<label><input type="checkbox" name="archive"' . ($row['arhiva'] ? ' checked' : '') . '> Arhiviraj</label>';

    echo '<div class="actions">';
    echo '<button type="submit" name="update">Ažuriraj</button>';
    echo '<button type="submit" name="delete">Obriši</button>';
    echo '</div>';
    echo '</form>';
  }
  ?>
</main>
<footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>
</body>
 
</html>
