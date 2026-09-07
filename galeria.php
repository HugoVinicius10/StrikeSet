<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Galeria | StrikeSet Gaspar</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="visual/css/global.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="visual/css/galeria.css?v=<?php echo time(); ?>">

</head>

<body>

<?php require_once __DIR__ . '/includes/header.php'; ?>

<section class="galeria-section">

<div class="container">

<div class="galeria-header">
<h1>Nossa Galeria</h1>

<p>
Confira os melhores momentos do StrikeSet Gaspar!
Treinos, campeonatos e toda energia do nosso time.
</p>
</div>


<div class="galeria-grid">


<!-- CARD TREINO -->

<div class="galeria-card" data-bs-toggle="modal" data-bs-target="#modalTreino">

<img src="visual/images/treino1.avif">

<div class="galeria-card-body">

<h5>Treinos</h5>

<p>Preparação para o campeonato regional</p>

<p class="data">10 Jan 2026</p>

</div>

</div>



<!-- CARD CAMPEONATO -->

<div class="galeria-card" data-bs-toggle="modal" data-bs-target="#modalCamp">

<img src="visual/images/camp1.avif">

<div class="galeria-card-body">

<h5>Campeonato Regional</h5>

<p>Final contra Blumenau</p>

<p class="data">22 Fev 2026</p>

</div>

</div>



<!-- CARD TIME -->

<div class="galeria-card" data-bs-toggle="modal" data-bs-target="#modalTime">

<img src="visual/images/time1.avif">

<div class="galeria-card-body">

<h5>Nosso Time</h5>

<p>Foto da temporada 2026</p>

<p class="data">30 Mar 2026</p>

</div>

</div>


</div>

</div>

</section>


<!-- MODAL TREINO -->

<div class="modal fade" id="modalTreino">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">Treinos</h5>

<button class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">


<div id="carouselTreino" class="carousel slide">

<div class="carousel-inner">


<div class="carousel-item active">

<img src="visual/images/treino1.avif" class="d-block w-100">

</div>


<div class="carousel-item">

<img src="visual/images/treino2.avif" class="d-block w-100">

</div>

</div>


<button class="carousel-control-prev" data-bs-target="#carouselTreino" data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>


<button class="carousel-control-next" data-bs-target="#carouselTreino" data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>


</div>

</div>

</div>

</div>

</div>



<!-- MODAL CAMPEONATO -->

<div class="modal fade" id="modalCamp">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">Campeonato Regional</h5>

<button class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div id="carouselCamp" class="carousel slide">

<div class="carousel-inner">

<div class="carousel-item active">

<img src="visual/images/camp1.avif" class="d-block w-100">

</div>

<div class="carousel-item">

<img src="visual/images/camp2.avif" class="d-block w-100">

</div>

</div>

<button class="carousel-control-prev" data-bs-target="#carouselCamp" data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next" data-bs-target="#carouselCamp" data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

</div>

</div>

</div>

</div>



<!-- MODAL TIME -->

<div class="modal fade" id="modalTime">

<div class="modal-dialog modal-lg modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">Nosso Time</h5>

<button class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

<div id="carouselTime" class="carousel slide">

<div class="carousel-inner">

<div class="carousel-item active">

<img src="visual/images/time1.avif" class="d-block w-100">

</div>

<div class="carousel-item">

<img src="visual/images/time2.avif" class="d-block w-100">

</div>

</div>

<button class="carousel-control-prev" data-bs-target="#carouselTime" data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button class="carousel-control-next" data-bs-target="#carouselTime" data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

</div>

</div>

</div>

</div>


<footer>

<p>StrikeSet Gaspar</p>

<div>

<img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/instagram.svg">

<img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/x.svg">

<img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/whatsapp.svg">

</div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
