<?php
$page_selected = "index";
 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="styles/css/discussion.css">
     <link rel="stylesheet" href="styles/css/fa.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Home - Discussion</title>
   </head>
   <body>
     <header>
       <?php
       include 'header.php';
        ?>
     </header>
     <main>
       <div class="content">
         <div class="css_base2">
           <p class="accroche margin1" >Welcome to my chatbox !<br>
           If you want to discuss, you can click on "Chat" or you can <a href="discussion.php"><em>click here</em></a><br>
           You have to be <a href="connexion.php"><em>logged in</em></a> to write a message and if you don't have an account yet, you can <a href="inscription.php"><em>register here</em></a>.</p>
         </div>
       </div>
     </main>
     <footer>

     </footer>
   </body>
 </html>
