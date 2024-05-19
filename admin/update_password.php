<?php 
if (!file_exists('../conn.php')) {
  header("Location: error");
  exit();
} else {
  include ('../app.php');
  $response = update_pass(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Spotex Srl">
    <meta name="generator" content="Gestionale 2.0">
    <title>LinkBay - <?php echo $risultato; ?></title>
    <link rel="shortcut icon" href="materials/favicon_link.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="materials/login.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="materials/dashboard.css" rel="stylesheet">
  </head>
  <body class="text-center">

  <video autoplay muted loop id="myVideo" style="position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%;">
    <source src="materials/video_background.mp4" type="video/mp4">
    Il tuo browser non supporta il tag video.
  </video>

  <div class="card">
    <main class="form-signin">
    <h1 class="h3 mb-3 fw-normal">Stato aggiornamento:</h1>
        <?php if ($response['risultato'] == 'Successo'): ?>
            <p class="text-success">Password aggiornata con successo.</p>
        <?php else: ?>
            <p class="text-danger"><?php echo $response['errore']; ?></p>
        <?php endif; ?>
        <br>
        <p><strong><a href="index.php" class="text-decoration-none text-dark">Accedi</a></strong></p>
        <br>
        <p class="mt-5 mb-3 text-muted">© <?php echo date('Y'); ?> Sviluppato da Spotex Srl <img src="materials/favicon.ico" width="20px"></p>
    </main>
 </div>
  </body>
</html>
