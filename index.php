<?php
session_start();
if (!file_exists('conn.php')) {
    header("Location: error");
    exit();
} else {
    require_once 'app.php';
    require 'visita.php';
    require 'conn.php';

    // Funzione per sostituire i placeholder del carrello
    function replaceCartPlaceholders($content, $cart)
    {
        $cartItemsHTML = '';

        foreach ($cart as $item) {
            $cartItemsHTML .= '
        <div class="row mb-3">
            <div class="col-md-3">
                <img src="' . htmlspecialchars($item['image_url']) . '.jpg" class="img-fluid" alt="' . htmlspecialchars($item['titolo']) . '">
            </div>
            <div class="col-md-6">
                <h5>' . htmlspecialchars($item['titolo']) . '</h5>
                <p>' . htmlspecialchars($item['descrizione']) . '</p>
                <p> PROVA ' . htmlspecialchars($item['id_prodotto']) . '</p>
            </div>
            <div class="col-md-3 text-end">
                <p class="mb-0">' . htmlspecialchars($item['quantita']) . '  x € ' . htmlspecialchars($item['prezzo']) . ' </p>
                <form method="post" action="public/rimuovi_carrello.php">
                    <input type="hidden" name="titolo" value="' . htmlspecialchars($item['titolo']) . '">
                    <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Rimuovi</button>
                </form>
            </div>
        </div>';
        }

        return str_replace('{{elementiCarrello}}', $cartItemsHTML, $content);
    }

    function replaceTotalOrderPlaceholders($content, $cart)
    {
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['prezzo'] * $item['quantita'];
        }

        $taxRate = 0.22;
        $taxes = $subtotal * $taxRate;
        $total = $subtotal + $taxes;

        $totalOrderHtml = '
        <div class="row mb-3">
            <div class="d-flex justify-content-between">
            <p>Sub-totale</p>
            <p>€ ' . number_format($subtotal, 2) . '</p>
            </div>
            <div class="d-flex justify-content-between">
                <p>Tasse (22%)</p>
                <p>€ ' . number_format($taxes, 2) . '</p>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <h5>Totale</h5>
                <h5>€ ' . number_format($total, 2) . '</h5>
            </div>
        </div>
        ';

        return str_replace('{{elementiTotaleOrdine}}', $totalOrderHtml, $content);
    };

    if (isset($_GET['slug'])) {
        $slug = htmlspecialchars($_GET['slug'], ENT_QUOTES, 'UTF-8');

        if ($slug === 'cart') {
            if (isset($_SESSION['carrello']) && !empty($_SESSION['carrello'])) {
                $stmt = $conn->prepare("SELECT content FROM editor_contents WHERE name_page = 'cart'");
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $savedContent = $row['content'];
                    $cartPageContent = replaceCartPlaceholders($savedContent, $_SESSION['carrello']);
                    $cartPageContent = replaceTotalOrderPlaceholders($cartPageContent, $_SESSION['carrello']);
                } else {
                    $cartPageContent = 'Il contenuto del carrello non è disponibile.';
                }
            } else {
                $cartPageContent = '<br><br><br><br><div class="content py-5 p-5"><div class="card"><div class="card-body">Il tuo carrello è vuoto.</div></div></div><br><br><br><br>';
            }
        } else {
            $stmt = $conn->prepare("SELECT * FROM seo WHERE slug = ?");
            $stmt->bind_param('s', $slug);
            $stmt->execute();
            $result = $stmt->get_result();
            $page = $result->fetch_assoc();

            if (!$page) {
                header("Location: error.php");
                exit();
            }
        }
    } else {
        $slug = 'home';
        $stmt = $conn->prepare("SELECT * FROM seo WHERE slug = ?");
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $page = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($slug === 'cart' ? 'Carrello' : $page['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($slug === 'cart' ? 'Il tuo carrello' : $page['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($slug === 'cart' ? 'carrello, acquisti' : $page['keywords']); ?>">
    <link rel="shortcut icon" href="src/media_system/favicon_site.ico" type="image/x-icon">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($slug === 'cart' ? 'Carrello' : $page['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($slug === 'cart' ? 'Il tuo carrello' : $page['description']); ?>">
    <meta property="og:image" content="src/media_system/logo_site.png">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">

    <link rel="shortcut icon" href="src/media_system/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <?php include 'marketing/market_integration.php'; ?>
</head>

<body>

    <?php
    customNav();
    if ($slug === 'cart') {
        echo $cartPageContent;
    } else {
        $namePage = isset($_GET['slug']) ? $_GET['slug'] : 'home';
        customPage($namePage);
    }
    customFooter();
    include('public/cookie_banner.php');
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>