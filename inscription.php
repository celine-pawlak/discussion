<?php
$page_selected = "inscription";
 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Register - Discussion</title>
     <link rel="stylesheet" href="styles/css/fa.css">
     <link rel="stylesheet" href="styles/css/discussion.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
     <header>
       <?php include 'header.php';
       $errors = [];
       if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password_conf']))
       {
         /*LOGIN*/
         $login = $_POST['login'];
         $login_required = preg_match("/^(?=.*[A-Za-z0-9]$)[A-Za-z][A-Za-z\d\-\_]{3,19}$/", $login);
         if (!$login_required)
         {
           $errors[] = "Login must :<br>- Contain between 4 and 20 characters.<br>- Start with a letter.<br>- End with a letter or a number.<br>- Not contain any special characters (except - and _).";
         }
         $request = "SELECT login FROM utilisateurs WHERE login  = '" . $login . "';";
         $query = mysqli_query($db, $request);
         $login_check = mysqli_fetch_array($query);
         if (!empty($login_check))
         {
           $errors[] = "This user already exists.";
         }

         /*PASSWORD*/
         $password_init = $_POST['password'];
         $password_conf = $_POST['password_conf'];
         $password_required = preg_match("/^(?=.*?[A-Z]{1,})(?=.*?[a-z]{1,})(?=.*?[0-9]{1,})(?=.*?[\W]{1,}).{8,20}$/", $password_init);
         if (!$password_required)
         {
           $errors[] = "Password must :<br>- contain between 8 and 20 characters<br>- contain at least : 1 special character, 1 number, 1 upper and 1 lower case.";
         }
         if ($password_init != $password_conf)
         {
           $errors[] = "Passwords are not identical.";
         }

         /*ENVOI BDD*/
         if (empty($errors))
         {
           $password_modified = password_hash($password_init, PASSWORD_BCRYPT, array('cost' => 10));
           $request = "INSERT INTO utilisateurs(login, password) VALUES ('" . $login . "','" . $password_modified . "')";
           $query = mysqli_query($db, $request);
           header('location: connexion.php');
         }
       }
       elseif (!empty($_POST))
       {
         $errors[] = "Every field must be filled.";
       }

        ?>
     </header>
     <main>
       <div class="content">
         <?= renderErrors($errors) ?>
         <h2>Register</h2>
         <form class="" action="inscription.php" method="post">
           <div class="form_element">
             <label for="login">Login</label>
             <input type="text" name="login" value="" placeholder="login" required>
           </div>
           <div class="form_element">
             <label for="password">Password</label>
             <input type="password" name="password" value="" placeholder="password" required>
           </div>
           <div class="form_element">
             <label for="password_conf">Confirm password</label>
             <input type="password" name="password_conf" value="" placeholder="confirm password" required>
           </div>
           <button type="submit" name="register_submit">Register</button>
         </form>
       </div>
     </main>
     <footer>
       <!-- A FAIRE -->
     </footer>
   </body>
 </html>
