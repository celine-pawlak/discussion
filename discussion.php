<?php
$page_selected = "discussion";
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Chat - Discussion</title>
    <link rel="stylesheet" href="styles/css/discussion.css">
    <link rel="stylesheet" href="styles/css/fa.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <header>
      <?php
      include 'header.php';
      include 'message.php';
      ?>
    </header>
    <main>
      <div class="content">
        <?= renderErrors($errors) ?>
        <div class="chat_box css_base2">
          <?php
          $request = "SELECT * FROM messages";
          $query = mysqli_query($db, $request);
          $messages_registered = mysqli_fetch_all($query);
          foreach ($messages_registered as $key => $message_registered) { ?>
            <div class="message">
              <?php
              $request = "SELECT login FROM utilisateurs WHERE id = '" . $message_registered[2] . "';";
              $query = mysqli_query($db, $request);
              $login_from_message = mysqli_fetch_array($query); ?>
              <div class="message_infos">
                <p> <?= $login_from_message[0]; ?> </p>
                <?="&nbsp;"?>
                <p> <?= $message_registered[3]; ?> </p>
              </div>
              <div>
                <p> <?= $message_registered[1]; ?> </p>
              </div>
            </div>
        <?php  }  ?>
        </div>
        <div class="add_message">
          <form class="form_discussion" action="discussion.php" method="post">
            <textarea  class="textarea_message css_base2" name="message" value="" placeholder="Send your message" rows="2" required></textarea>
            <button class="button_message css_base2" type="submit" name="submit_message"><i class="far fa-share-square"></i></button>
          </form>
        </div>
      </div>
    </main>
    <footer>

    </footer>
  </body>
</html>
