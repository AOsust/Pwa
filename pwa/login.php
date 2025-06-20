<?php
session_start();
include 'connect.php';

$greska = "";
$prikazi_registraciju = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $pass = $_POST['pass'];

  $stmt = mysqli_prepare($dbc, "SELECT lozinka, razina FROM korisnik WHERE korisnicko_ime=?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_bind_result($stmt, $hash, $razina);
    mysqli_stmt_fetch($stmt);

    if (password_verify($pass, $hash)) {
      $_SESSION['username'] = $username;
      $_SESSION['level'] = $razina;
      header("Location: administracija.php");
      exit;
    } else {
      $greska = "❌ Pogrešna lozinka.";
    }
  } else {
    $greska = "❌ Korisnik ne postoji.";
    $prikazi_registraciju = true;
  }
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Prijava</title>
  <style>
    *{ font-family: 'Georgia', serif;}
    body {
      font-family: 'Georgia', serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {
      color: white;
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid #ccc;
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
    main {
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 5px;
    }
    h2 {
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    input {
      padding: 10px;
      font-size: 16px;
    }
    button {
      padding: 10px;
      background-color: #003366;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
    .register-box {
      text-align: center;
      margin-top: 20px;
      padding: 15px;
      background-color: #f0f0f0;
    }
    .register-box a {
      color: #003366;
      font-weight: bold;
      text-decoration: none;
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
    <a href="registracija.php">REGISTRACIJA</a>
  </nav>
</header>

<main>
  <h2>Prijava korisnika</h2>

  <?php if (!empty($greska)) echo "<div class='error'>$greska</div>"; ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Korisničko ime" required>
    <input type="password" name="pass" placeholder="Lozinka" required>
    <button type="submit">Prijavi se</button>
  </form>

  <?php if (!empty($prikazi_registraciju)): ?>
    <div class="register-box">
      <p>Nemate račun?</p>
      <a href="registracija.php">Registrirajte se</a>
    </div>
  <?php endif; ?>
</main>
<footer>
    <p>&copy; Antun Ošust-0246117225</p>
  </footer>
</body>
 
</html>
