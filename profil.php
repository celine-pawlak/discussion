<?php
$page_selected = "profil";
 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Profile - Discussion</title>
     <link rel="stylesheet" href="styles/css/fa.css">
     <link rel="stylesheet"  type="text/css" href="styles/css/discussion.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
     <header>
       <?php
       include 'header.php';
       $errors = [];
       $request = "SELECT * FROM utilisateurs WHERE id = '" . $_SESSION['id'] . "';";
       $query = mysqli_query($db, $request);
       $user_info = mysqli_fetch_array($query);

       /*LOGIN*/
       if (!empty($_POST['new_login']) AND !empty($_POST['new_login_conf']) AND isset($_POST['new_login_submit']))
      {
        $new_login = $_POST['new_login'];
        $new_login_conf = $_POST['new_login_conf'];
        if ($new_login != $new_login_conf)
        {
          $errors[] = "Logins are not identical.";
        }

        $request = "SELECT login FROM utilisateurs WHERE login = '" . $new_login . "';";
        $query = mysqli_query($db, $request);
        $login_check = mysqli_fetch_array($query);
        if (!empty($login_check))
        {
          $errors[] = "This login already exist.";
        }
        $login_required = preg_match("/^(?=.*[A-Za-z0-9]$)[A-Za-z][A-Za-z\d\-\_]{3,19}$/", $new_login);
        if (!$login_required)
        {
          $errors[] = "Login must :<br>- Contain between 4 and 20 characters.<br>- Start with a letter.<br>- End with a letter or a number.<br>- Not contain any special characters (except - and _).";
        }
        if (empty($errors))
        {
          $request_new_login = "UPDATE utilisateurs SET login = '" . $new_login . "' WHERE id = '" . $_SESSION['id'] . "';";
          mysqli_query($db, $request_new_login);
          // header('location: profil.php');
          echo "Login has been modified !";
        }
      }
      elseif (isset($_POST['new_login_submit']) AND (empty($_POST['new_login']) OR empty($_POST['new_login_conf'])))
      {
        $errors[] = "Both login fields must be filled.";
      }

      /*PASSWORD*/
      if (!empty($_POST['old_pass']) AND !empty($_POST['new_pass']) AND !empty($_POST['new_pass_conf']) AND isset($_POST['new_pass_submit']))
      {
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];
        $new_pass_conf = $_POST['new_pass_conf'];
        if (!password_verify($old_pass, $user_info['password']))
        {
          $errors[] = "Your old password is wrong.";
        }
        elseif (password_verify($new_pass, $user_info['password']))
        {
          $errors[] = "New password must be different from the old one.";
        }
        if ($new_pass != $new_pass_conf)
        {
          $errors[] = "Passwords are not identical.";
        }
        $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $new_pass);
        if (!$password_required)
        {
          $errors[]= "Password must :<br>- contain between 8 and 20 characters<br>- contain at least 1 special character, 1 number, 1 upper and 1 lower case.";
        }
        if (empty($errors)) {
          $password_modified = password_hash($new_pass, PASSWORD_BCRYPT, array('cost' => 10));
          $request = "UPDATE utilisateurs SET password = '" . $password_modified . "' WHERE id = '" . $_SESSION['id'] . "';";
          $query = mysqli_query($db, $request);
          // header('location: profil.php');
          echo "Password has been modified !";
        }
      }
      elseif (isset($_POST['new_pass_submit']) AND ((empty($_POST['old_pass']) OR empty($_POST['new_pass']) OR empty($_POST['new_pass_conf']))))
      {
        $errors[] = "All password fields must be filled.";
      }
        ?>
     </header>
     <main>
       <div class="content">
         <?= renderErrors($errors) ?>
         <h2>Profile</h2>
         <form class="" action="profil.php" method="post">
           <h3>Modify Login</h3>
           <div class="form_element">
             <label for="new_login">New login</label>
             <input type="text" name="new_login" value="" placeholder="new login" required>
           </div>
           <div class="form_element">
             <label for="new_login_conf">Confirm new login</label>
             <input type="text" name="new_login_conf" value="" placeholder="confirm new login" required>
           </div>
           <button type="submit" name="new_login_submit">Confirm new login</button>
         </form>
         <form class="" action="profil.php" method="post">
           <h3>Modify password</h3>
           <div class="form_element">
             <label for="old_pass">Old password</label>
             <input type="password" name="old_pass" value="" placeholder="old password" required>
           </div>
           <div class="form_element">
             <label for="new_pass">New password</label>
             <input type="password" name="new_pass" value="" placeholder="new password" required>
           </div>
           <div class="form_element">
             <label for="old_pass_conf">Confirm old password</label>
             <input type="password" name="new_pass_conf" value="" placeholder="confirm new password" required>
           </div>
           <button type="submit" name="new_pass_submit">Confirm new password</button>
         </form>
       </div>
     </main>
   </body>
 </html>
