<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "discussion");

/*redirections de sessions*/

if (in_array($page_selected, ['profil','discussion']) AND !$_SESSION['id'])
{
  header('location: connexion.php');
}
if (in_array($page_selected, ['connexion','inscription']) AND isset($_SESSION['id']))
{
  header('location: index.php');
}

/*fonction erreurs*/

/**
  * @param $errors
  * @return string
  */
function renderErrors($errors)
{
  if (!empty($errors))
  {
    $output = "";
    if (count($errors) > 1)
    {
      $output .= "<ul>";
      foreach ($errors as $error)
      {
        $output .= "<li>" . $error . "</li>";
      }
      $output .= "</ul>";
    }
    else
    {
      $output = $errors[0];
    }
    return "<div class=\"ErrorMessage\">"
      . $output .
      "</div>";
  }
  else
  {
    return "";
  }
}
 ?>

<!-- header html -->

<nav>
  <div class="header_1">
    <a href="index.php"><h1>Home</h1></a>
  </div>
  <div class="header_2">
    <a href="discussion.php"><h1>Chat</h1></a>
  </div>
  <div class="header_3">
    <?php if (isset($_SESSION['id']))
    { ?>
      <ul>
        <li class="liste">
          <h1>My account</h1>
          <ul class="sous_liste">
            <li><a href="profil.php">Modify login and/or password</a></li>
            <li><a href="delete_session.php">Disconnect</a></li>
          </ul>
        </li>
      </ul>
    <?php }
    else { ?>
        <a href="connexion.php"><h1>Connect</h1></a>
        <?="&nbsp;"?><p>or</p><?="&nbsp;"?>
        <a href="inscription.php"><h1>Register</h1></a>
    <?php } ?>
  </div>
</nav>
