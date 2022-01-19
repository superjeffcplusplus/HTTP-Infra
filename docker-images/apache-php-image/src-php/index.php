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
  <h1>Load balancing avec sticky session</h1>

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

  <h3>Infos sur le serveur statique:</h3>
  <p>Hostname : <?= $hostname ?></p>

  <h3>Infos sur le serveur dynamique :</h3>
  <ul id="webDynInfo"></ul>

  <h3>Cookies :</h3>
  <ul id="cookies" >
 <!-- Complété par le script -->
  </ul>

  <button id="reload" class="w3-button w3-white">Reload</button>

  <button id="autoReload" class="w3-button w3-white">Auto reload ON</button>

  <button id="webDyn" class="w3-button w3-white">Fetch web_dynamic</button>


</body>

<script>
  /**
   * Script pour recharger la page sans renvoyer les headers
   */
  document.querySelector("#reload").addEventListener("click", (event) => {
    window.location = "/";
  })

  let autoreload = true;
  
  document.querySelector("#autoReload").addEventListener("click", (event) => {
    if (autoreload) {
      autoreload = false;
      event.target.innerHTML = "Auto reload OFF";
    } else {
      autoreload = true;
      localStorage.setItem("autoreload", "true")
    }
  })

  // recharge la page à intervale régulier
  window.setInterval(() => {
    if (autoreload) {
      window.location = "/"
    }
  }, 2000);

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

<script>
  /**
   * Script pour faire des requête au serveur Node
   */
  const fetchDyn = () => {
  window.fetch("server-info/")
  .then((response) => {return response.json()})
  .then((body) => {
    document.querySelector("#webDynInfo").innerHTML = 
     "<ul><li>Hostname   : " + body.serverName + "</li>"
     + "  <li>IP Address : " + body.ipAddress + "</li></ul>";
  })}
  document.querySelector("#webDyn").addEventListener("click", fetchDyn);
</script>

</html>
