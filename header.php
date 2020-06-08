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
  <div class="header_1 hand">
    <a href="index.php"><i class="fa fa-hand-point-right"></i><h1>Home</h1></a>
  </div>
  <div class="header_2 hand">
    <a href="discussion.php"><i class="fa fa-hand-point-right"></i><h1>Chat</h1></a>
  </div>
  <div class="header_3">
    <?php if (isset($_SESSION['id']))
    { ?>
      <ul>
        <li class="liste">
          <i class="fa fa-hand-point-right hand_1"></i><h1> My account</h1>
          <ul class="sous_liste css_base">
            <li><i class="fa fa-hand-point-right hand_2"></i><a href="profil.php">Modify login and/or password</a></li>
            <li><i class="fa fa-hand-point-right hand_2"></i><a href="delete_session.php">Disconnect</a></li>
          </ul>
        </li>
      </ul>
    <?php }
    else { ?>
      <div class="hand">
        <a href="connexion.php"><i class="fa fa-hand-point-right"></i><h1> Connect</h1></a>
      </div>
      <p>or</p>
      <div class="hand">
          <a href="inscription.php"><i class="fa fa-hand-point-right"></i><h1> Register</h1></a>
      </div>
    <?php } ?>
  </div>
</nav>
