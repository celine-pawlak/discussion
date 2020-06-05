<?php
$errors = [];
if (!empty($_POST['message']) AND isset($_POST['submit_message']))
{
  if (isset($_SESSION['id']))
  {
    $message = $_POST['message'];
    $message_required = preg_match("/^.{2,140}$/", $message);
    if (!$message_required)
    {
      $errors[] = "Your message must contain between 2 and 140 characters.";
    }
    if (empty($errors))
    {
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');
    $request = "INSERT INTO messages(`message`, `id_utilisateur`, `date`) VALUES('" . $message . "', '" . $_SESSION['id'] . "', '" . $date . "')";
    $query = mysqli_query($db, $request);
    header('location: discussion.php');
    }
  }
  else
  {
    $errors[] = "You must have an account to write a message !";
  }
}
 ?>
