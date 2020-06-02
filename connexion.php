<?php
$page_selected = "connexion";
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log in - Discussion</title>
    <link rel="stylesheet" href="styles/css/discussion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <header>
      <?php
      include 'header.php';
      $errors = [];

      if (!empty($_POST['login']) AND !empty($_POST['password']))
      {
        /*LOGIN*/
        $login = $_POST['login'];
        $request = "SELECT login FROM utilisateurs WHERE login = '" . $login . "';";
        $query = mysqli_query($db, $request);
        $login_check = mysqli_fetch_array($query);
        if (empty($login_check))
        {
          $errors[] = "This user does not exists."
        }

        /*PASSWORD*/
        $password = $_POST['password'];
        $request = "SELECT password FROM utilisateurs WHERE id = '" . $login_check[0] . "';";
        $query = mysqli_query($db, $request);
        $password_check = mysqli_fetch_array($query);
        if (password_verify($password, $password_check[0]))
        {
          $_SESSION['id'] = $login_check[0];
          header('location: index.php');
        }
        else
        {
          $errors[] = "Password is incorrect."
        }
      }
      elseif (empty($_POST))
      {
        $errors[] = "Every field must be filled.";
      }
       ?>
    </header>
    <main>
      <div class="content">
        <form class="" action="connexion.php" method="post">
          <div class="form_element">
            <label for="login">Login</label>
            <input type="text" name="login" value="" placeholder="login">
          </div>
          <div class="form_element">
            <label for="password">Password</label>
            <input type="text" name="password" value="" placeholder="password">
          </div>
          <button type="submit" name="connect_submit">Log in</button>
        </form>
      </div>
    </main>
    <footer>

    </footer>
  </body>
</html>
