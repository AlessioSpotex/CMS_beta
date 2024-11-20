<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 800;">
  <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3">
      <!-- Il toast verrà aggiunto qui dinamicamente -->
  </div>
</div>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-2 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"><img src="../materials/logo_sidebar.png" width="130px" alt=""></a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="form-control-dark w-100"></div>
        <!-- UTENTE LOGGATO -->
        <ul class="nav flex-column">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="fas fa-user"></span>&nbsp;<?php echo $_SESSION['nome'];?>&nbsp;<?php echo $_SESSION['cognome'];?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item">Ruolo:&nbsp;<?php echo $_SESSION['ruolo'];?></a></li>
              <li><a class="dropdown-item" href="https://wa.me/3899657115?text=Ciao!%20Ho%20bisogno%20di%20aiuto%20su%20questo.."><i class="fa-solid fa-comments"></i></i>&nbsp; Chat</a></li>
              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-headset"></i></i>&nbsp; Centro Assistenza</a></li>
              <li><hr class="dropdown-divider"></li>
                <a href="../logout" class="dropdown-item"> <i class="fa-solid fa-right-from-bracket"></i>&nbsp; Esci</a>
            </ul>
          </li>
        </ul>
</header>


<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <!-- Link -->
          <li class="nav-item">
            <a class="link-dark rounded <?php if($currentPage == 'homepage.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>" href="homepage">
            <span class="fas fa-home"></span>
              Dashboard
            </a>
          </li>

          <!-- Collapsible Gestione CLIENTI -->
          <li class="nav-item">
            <!-- MODIFICA CON PHP LA CLASSE false -->
            <a class="nav-link" data-bs-toggle="collapse" href="#gestioneClientiCollapse" role="button" aria-expanded="false" aria-controls="gestioneClientiCollapse">
            <i class="fa-solid fa-users"></i>
              Clienti
            </a>
                <!-- MODIFICA CON PHP LO show -->
            <div class="collapse <?php if($sidebar_cate == 'clienti'){echo 'show';} ?>" id="gestioneClientiCollapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="margin-left: 20px;">
                <!-- MODIFICA CON PHP IL  custom-link-active-->
                <li><a href="clienti" class="link-dark rounded <?php if($currentPage == 'clienti.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Lista Clienti</a></li>
              </ul>
            </div>
          </li>

          <!-- Collapsible Gestione MARKETING -->
          <li class="nav-item">
             <!-- MODIFICA CON PHP LA CLASSE false-->
            <a class="nav-link" data-bs-toggle="collapse" href="#gestioneMarketingCollapse" role="button" aria-expanded="false" aria-controls="gestioneMarketingCollapse">
            <i class="fa-solid fa-chart-simple"></i>
              Marketing
            </a>
                 <!-- MODIFICA CON PHP LO show-->
            <div class="collapse <?php if($sidebar_cate == 'marketing'){echo 'show';} ?>" id="gestioneMarketingCollapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="margin-left: 20px;">
                 <!-- MODIFICA CON PHP IL  custom-link-active-->
                <li><a href="analisi" class="link-dark rounded <?php if($currentPage == 'analisi.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Analisi</a></li>
                <li><a href="leads" class="link-dark rounded <?php if($currentPage == 'leads.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Leads</a></li>
                <li><a href="campagne" class="link-dark rounded <?php if($currentPage == 'campagne.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Campagne</a></li>
              </ul>
            </div>
          </li>


          <!-- Collapsible Gestione APP -->
          <li class="nav-item">
             <!-- MODIFICA CON PHP LA CLASSE false-->
            <a class="nav-link" data-bs-toggle="collapse" href="#gestioneAppCollapse" role="button" aria-expanded="false" aria-controls="gestioneAppCollapse">
            <i class="fa-solid fa-square-plus"></i>
              Applicazioni e Plugin
            </a>
                 <!-- MODIFICA CON PHP LO show-->
            <div class="collapse <?php if($sidebar_cate == 'App'){echo 'show';} ?>" id="gestioneAppCollapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="margin-left: 20px;">
                 <!-- MODIFICA CON PHP IL  custom-link-active-->
                <li><a href="chat_clienti" class="link-dark rounded <?php if($currentPage == 'chat_clienti.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Chat con Clienti</a></li>
              </ul>
            </div>
          </li>


          <!-- Collapsible Gestione NEGOZIO -->
          <li class="nav-item">
             <!-- MODIFICA CON PHP LA CLASSE false-->
            <a class="nav-link" data-bs-toggle="collapse" href="#gestioneNegozioCollapse" role="button" aria-expanded="false" aria-controls="gestioneNegozioCollapse">
            <i class="fa-solid fa-store"></i>
            Editor Sito Web
            </a>
                 <!-- MODIFICA CON PHP LO show-->
            <div class="collapse <?php if($sidebar_cate == 'negozio'){echo 'show';} ?>" id="gestioneNegozioCollapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="margin-left: 20px;">
                <li><a href="editor_negozio" class="link-dark rounded <?php if($currentPage == 'editor_negozio.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Modifica Sito Web</a></li>
                <li><a href="brand_identity" class="link-dark rounded <?php if($currentPage == 'brand_identity.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Brand identity</a></li>
              </ul>
            </div>
          </li>

          <!-- Collapsible Gestione IMPOSTAZIONI -->
          <li class="nav-item">
            <!-- MODIFICA CON PHP LA CLASSE false -->
            <a class="nav-link" data-bs-toggle="collapse" href="#gestioneSettingCollapse" role="button" aria-expanded="false" aria-controls="gestioneSettingCollapse">
            <i class="fa-solid fa-gear"></i>
              Impostazioni
            </a>
                <!-- MODIFICA CON PHP LO show -->
            <div class="collapse <?php if($sidebar_cate == 'impostazioni'){echo 'show';} ?>" id="gestioneSettingCollapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small" style="margin-left: 20px;">
                <!-- MODIFICA CON PHP IL  custom-link-active-->
                <li><a href="dettagli_negozio" class="link-dark rounded <?php if($currentPage == 'dettagli_negozio.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Dettagli Sito Web</a></li>
                <li><a href="utenti_ruoli" class="link-dark rounded <?php if($currentPage == 'utenti_ruoli.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Utenti e Ruoli</a></li>
                <li><a href="ore_assistenza" class="link-dark rounded <?php if($currentPage == 'ore_assistenza.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Ore Assistenza</a></li>
                <li><a href="piano_contratto" class="link-dark rounded <?php if($currentPage == 'piano_contratto.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Piano/Contratto</a></li>
                <li><a href="aggiornamento" class="link-dark rounded <?php if($currentPage == 'aggiornamento.php'){echo 'custom-link-active';}else{echo 'custom-link';} ?>">Aggiornamento Software</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</div>

<style>
  .custom-link {
    display: block;
    padding: 5px 10px;
    margin: 5px 0;
    background-color: #f8f9fa; /* Sfondo chiaro per i link, puoi scegliere qualsiasi colore */
    color: Black; /* Colore del testo, puoi scegliere qualsiasi colore */
    border-radius: 5px; /* Angoli arrotondati */
    text-decoration: none; /* Rimuove il sottolineamento */
    transition: background-color 0.2s ease-in-out; /* Effetto di transizione per il passaggio del mouse */
  }

  .custom-link:hover {
    background-color: #e2e6ea; /* Cambia lo sfondo al passaggio del mouse */
    text-decoration: none; /* Mantiene rimosso il sottolineamento */
    color: #ff5758; /* Cambia il colore del testo al passaggio del mouse */
    padding: 10px; /* Cambia grandezza del testo al passaggio del mouse */
    font-size: 0.9rem;
    transition: 0.3s;
  }

  .custom-link-active {
    display: block;
    padding: 5px 10px;
    margin: 5px 0;
    background-color: #e2e6ea; /* Cambia lo sfondo al passaggio del mouse */
    text-decoration: none; /* Mantiene rimosso il sottolineamento */
    color: #ff5758; /* Cambia il colore del testo al passaggio del mouse */
    padding: 10px; /* Cambia grandezza del testo al passaggio del mouse */
    font-size: 0.9rem;
  }
</style>


<script>
  let timeout;

// Resetta il timer di inattività all'interazione dell'utente
function resetTimer() {
    clearTimeout(timeout); // Azzera il timer precedente
    timeout = setTimeout(() => {
        // Mostra il toast di avviso
        showToast();
    }, 1200000); // Imposta il timer per 20 minuti (1 minuto 60.000)
}

// Funzione per mostrare il toast
function showToast() {
    const toastContainer = document.getElementById('toastContainer');
    const toastHTML = `
        <div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" style="z-index: 999;">
            <div class="d-flex">
                <div class="toast-body">
                  <i class="fa-solid fa-link-slash"></i>&nbsp; La tua sessione è scaduta. &nbsp;  <a href="../logout" class="btn btn-outline-light btn-sm">Accedi</a>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <br><br>
    `;
    toastContainer.innerHTML = toastHTML;
    const toastElement = new bootstrap.Toast(toastContainer.querySelector('.toast'), {delay: 300000});
    toastElement.show();
}

// Aggiungi event listener per resettare il timer all'interazione dell'utente
document.addEventListener('mousemove', resetTimer);
document.addEventListener('keypress', resetTimer);

// Avvia il timer
resetTimer();

</script>