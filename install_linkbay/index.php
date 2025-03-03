<?php
if (file_exists('../conn.php')) {
  header("Location: ../admin/");
  exit();
} else {
    $localVersionFile = '../version.txt';
    $versionContent = '';
    
    if (file_exists($localVersionFile)) {
        $versionContent = file_get_contents($localVersionFile);
        $versionContent = trim($versionContent);
    } else {
        $versionContent = 'Version file not found';
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Abilita il buffer di output per prevenire l'output prima del header()
        ob_start();
    
        $host = $_POST['host'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dbname = $_POST['dbname'];
    
        try {
            // Abilita le eccezioni per MySQLi
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
            // Creare una nuova connessione MySQLi
            $conn = new mysqli($host, $username, $password);
    
            // Creare il database
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            $conn->query($sql);
    
            // Seleziona il database
            $conn->select_db($dbname);
    
            // Funzione per eseguire file SQL
            function runSQLFile($conn, $file) {
                $queries = file_get_contents($file);
                $queries = explode(";", $queries);
    
                foreach ($queries as $query) {
                    $query = trim($query);
                    if (!empty($query)) {
                        $conn->query($query);
                    }
                }
            }
    
            // Esegui i file SQL
            runSQLFile($conn, 'CMS.sql');
    
            // Scrivi il file conn.php con le nuove credenziali di connessione
            $connFileContent = "<?php\n\n";
            $connFileContent .= "\$servername = \"$host\";\n";
            $connFileContent .= "\$username = \"$username\";\n";
            $connFileContent .= "\$password = \"$password\";\n";
            $connFileContent .= "\$dbname = \"$dbname\";\n\n";
            $connFileContent .= "\$conn = new mysqli(\$servername, \$username, \$password, \$dbname);\n";
            $connFileContent .= "if (\$conn->connect_error) {\n";
            $connFileContent .= "    die(\"Connessione al database fallita: \" . \$conn->connect_error);\n";
            $connFileContent .= "}\n\n?>";
    
            $filePath = '../conn.php';
    
            if (file_put_contents($filePath, $connFileContent) === FALSE) {
                throw new Exception("Errore durante la scrittura del file conn.php");
            }
    
            $conn->close();
            ob_end_clean(); // Pulisce il buffer di output
            echo "<script>window.location.href = 'installazione';</script>";
            exit();
        } catch (Exception $e) {
            ob_end_clean(); // Pulisce il buffer di output
            header("Location: errore.php?msg=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installazione LinkBay</title>
    <link rel="shortcut icon" href="../admin/materials/favicon_link.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/materials/login.css">
    <style>
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('../admin/materials/background.webp') no-repeat center center fixed;
            background-size: cover;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="card bg-light text-dark w-25">
        <div class="card-header text-center">
            <img src="../admin/materials/linkbay_logo.png" width="150px" alt="">
            <br><br>
            <h2 class="h3 mb-3 fw-normal" >Installazione LinkBay</h2>
        </div>
        <div class="card-body">
            <form method="post" id="updateForm">
                <div class="mb-3">
                    <label for="host" class="form-label">Host:</label>
                    <input type="text" id="host" name="host" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="dbname" class="form-label">Nome Database:</label>
                    <input type="text" id="dbname" name="dbname" class="form-control" required>
                </div>
                <button id="loadButton" type="submit" class="btn btn-danger" onclick="startLoading(event)">Installa Versione <?php echo htmlspecialchars($versionContent); ?></button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function startLoading(event) {
            var button = document.getElementById('loadButton');
            button.disabled = true; // Disabilita il pulsante
            button.innerHTML = 'In Corso<span class="dots">...</span>';
            button.classList.add('loading-button');
            
            // Avvia il submit del form
            document.getElementById('updateForm').submit();
        }
</script>
</body>
</html>
