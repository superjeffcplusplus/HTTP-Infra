<?php

session_start();

if (isset($_POST['connect'])) {
  if ($_POST['connect'] == "false") {
    session_destroy();
    header("Location: / ", true, 302);
    exit();
  } elseif ($_POST['connect'] == "true") {
    $_SESSION['user'] = "connected";
  }
}

$hostname = getenv('HOSTNAME');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Demo sticky session</title>
</head>

<body>
  <h1>Load balancing without sticky session</h1>

  <?php if (isset($_SESSION['user'])) : ?>
    <div class="w3-container w3-white">
      <p><b>Connecté</b></p>
      <form action="/" method="post">
        <button type=submit name="connect" value="false" class="w3-button w3-white">Deconnecter</button>
      </form>
    </div>
  <?php else : ?>
    <div class="w3-container w3-white">
      <p><b>Non connecté</b></p>
      <form action="/" method="post">
        <button type=submit name="connect" value="true" class="w3-button w3-white">Connecter</button>
      </form>
    </div>
  <?php endif ?>

  <h3>Infos sur le serveur :</h3>
  <p>Hostname web_static : <?= $hostname ?></p>

  <h3>Cookies :</h3>
  <ul id="cookies" >
 <!-- Complété par le script -->
  </ul>

  <button id="reload" class="w3-button w3-white">Reload</button>


</body>

<script>
  /**
   * Script pour recharger la page sans renvoyer les headers
   */
  document.querySelector("#reload").addEventListener("click", (event) => {
    window.location = "/";
  })
</script>

<script>
  /**
   * Script pour afficher les cookies
   */
  let cookies = document.cookie;
  cookies = cookies.split(";");
  cookies.forEach(element => {
    node = document.createElement("li");
    node.innerHTML = element;
    document.querySelector("#cookies").appendChild(node);
  });
</script>

</html>