<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
$appName = 'Swipe&Cook';
$appTagline = 'Des recettes qui matchent votre vraie cuisine.';
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="theme-color" content="#f5f0e8">
  <meta name="description" content="Trouvez votre prochaine recette par swipe et cuisinez pas à pas.">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <meta name="apple-mobile-web-app-title" content="Swipe&Cook">
  <link rel="manifest" href="manifest.webmanifest">
  <link rel="icon" href="assets/icons/icon-192.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="assets/icons/icon-192.svg">
  <link rel="mask-icon" href="assets/icons/icon-192.svg" color="#f08a5d">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css?v=20260922-1">
  <title><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
  <div class="app-shell">
    <header class="topbar">
      <a class="brand" href="#discover" aria-label="Retour à la découverte">
        <span class="brand-mark">S<span>+</span>C</span>
        <span class="brand-name">swipe<span>&</span>cook</span>
      </a>
      <button class="icon-button" id="install-button" type="button" aria-label="Installer l'application" hidden>↥</button>
    </header>

    <main>
      <section class="view active" id="discover-view" aria-labelledby="discover-title">
        <div class="section-intro">
          <div>
            <p class="eyebrow"><?= htmlspecialchars($appTagline, ENT_QUOTES, 'UTF-8') ?></p>
            <h1 id="discover-title">Qu'est-ce qui<br><em>vous tente ?</em></h1>
          </div>
          <button class="filter-trigger" id="filter-trigger" type="button"><span>Filtres</span><b id="filter-count">0</b></button>
        </div>

        <div class="filter-panel" id="filter-panel" hidden>
          <div class="filter-row">
            <label for="difficulty-filter">Difficulté</label>
            <select id="difficulty-filter">
              <option value="all">Toutes</option>
              <option value="Facile">Facile</option>
              <option value="Intermédiaire">Intermédiaire</option>
              <option value="Difficile">Difficile</option>
            </select>
          </div>
          <label class="toggle-row" for="fridge-filter"><span><strong>Avec mon frigo</strong><small>Prioriser les ingrédients déjà là</small></span><input type="checkbox" id="fridge-filter"><i></i></label>
        </div>

        <div class="swipe-stage" id="swipe-stage" aria-live="polite">
          <div class="swipe-card" id="recipe-card">
            <div class="recipe-image-wrap"><img class="recipe-image" id="recipe-image" src="" alt=""><span class="card-label" id="recipe-match">Nouveau</span><span class="swipe-stamp like">J'aime</span><span class="swipe-stamp nope">Passer</span></div>
            <div class="recipe-card-body"><div class="recipe-meta"><span id="recipe-category">Cuisine</span><span class="dot"></span><span id="recipe-time">30 min</span></div><h2 id="recipe-title">Chargement...</h2><p id="recipe-description"></p><div class="ingredient-preview" id="ingredient-preview"></div></div>
          </div>
          <div class="empty-state" id="empty-state" hidden><span class="empty-illustration">✦</span><h2>Votre pile est vide</h2><p>Changez vos filtres ou revenez plus tard pour de nouvelles idées.</p><button class="primary-button" id="reset-stack" type="button">Recommencer</button></div>
        </div>
        <div class="swipe-actions" aria-label="Actions sur la recette"><button class="round-action reject" id="reject-button" type="button" aria-label="Passer">×</button><button class="round-action info" id="info-button" type="button" aria-label="Voir les détails">i</button><button class="round-action accept" id="accept-button" type="button" aria-label="J'aime">♥</button></div>
        <p class="gesture-hint"><span>←</span> glissez pour choisir <span>→</span></p>
      </section>

      <section class="view" id="fridge-view" aria-labelledby="fridge-title">
        <div class="section-intro compact"><div><p class="eyebrow">Votre garde-manger</p><h1 id="fridge-title">Dans mon <em>frigo</em></h1></div><span class="ingredient-total" id="ingredient-total">0</span></div>
        <div class="search-box"><span>⌕</span><input id="ingredient-search" type="search" placeholder="Chercher un ingrédient..." autocomplete="off"><button id="clear-search" type="button" aria-label="Effacer la recherche">×</button></div>
        <div class="scan-banner"><div class="scan-icon">▣</div><div><strong>Scanner un produit</strong><small>Ajoutez-le en un clin d'oeil avec sa référence</small></div><button id="scan-button" type="button">Ouvrir</button></div>
        <div class="ingredient-heading"><h2>Ajouts rapides</h2><button id="shuffle-ingredients" type="button">Mélanger ↻</button></div><div class="ingredient-suggestions" id="ingredient-suggestions"></div>
        <div class="ingredient-heading"><h2>Mon frigo</h2><button id="clear-fridge" type="button">Tout retirer</button></div><div class="fridge-list" id="fridge-list"></div>
      </section>

      <section class="view" id="recipe-detail-view" aria-labelledby="detail-title"><div class="cook-header"><button class="back-button" id="back-to-discover" type="button">← <span>Découvrir</span></button><span class="step-counter" id="detail-category">Recette</span></div><div class="cook-hero"><img id="detail-image" src="" alt=""><div class="cook-hero-overlay"><span class="eyebrow">Votre prochaine assiette</span><h1 id="detail-title">Recette</h1></div></div><div class="cook-content"><p class="recipe-detail-description" id="detail-description"></p><div class="servings-control"><div><strong id="detail-servings-value">2 personnes</strong></div><div class="stepper"><button id="detail-servings-minus" type="button" aria-label="Moins de portions">−</button><button id="detail-servings-plus" type="button" aria-label="Plus de portions">+</button></div></div><div class="cook-section"><div class="section-heading"><h2>Ingrédients</h2><span id="detail-ingredient-count">0 éléments</span></div><ul class="ingredient-list" id="detail-ingredients"></ul></div><button class="primary-button start-cooking-button" id="start-cooking" type="button">Commencer à cuisiner</button></div></section>

      <section class="view" id="cook-view" aria-labelledby="cook-title"><div class="cook-header"><button class="back-button" id="back-to-detail" type="button">← <span>La recette</span></button><span class="step-counter" id="step-counter">Étape 1 / 1</span></div><div class="cook-hero"><img id="cook-image" src="" alt=""><div class="cook-hero-overlay"><span class="eyebrow">On cuisine ensemble</span><h1 id="cook-title">Recette</h1></div></div><div class="cook-content"><div class="cook-section instructions-section"><div class="section-heading"><h2>Pas à pas</h2></div><div class="instruction-card"><span class="instruction-number" id="instruction-number">01</span><div class="instruction-copy"><span class="instruction-phase" id="instruction-phase">Préparation</span><p id="instruction-text"></p><small class="instruction-ingredients" id="instruction-ingredients"></small><small class="instruction-cue" id="instruction-cue"></small></div></div><div class="progress-line"><i id="progress-line-fill"></i></div><div class="cook-actions"><button class="secondary-button" id="previous-step" type="button">Précédente</button><button class="primary-button" id="next-step" type="button">Suivante</button></div></div></div></section>
    </main>

    <nav class="bottom-nav" aria-label="Navigation principale"><a class="nav-item active" href="#discover" data-view="discover-view"><span>✦</span><small>Découvrir</small></a><a class="nav-item" href="#fridge" data-view="fridge-view"><span>⌁</span><small>Mon frigo</small></a></nav>
  </div>
  <div class="toast" id="toast" role="status"></div>
  <div class="modal-backdrop" id="scanner-modal" hidden><div class="scanner-modal" role="dialog" aria-modal="true" aria-labelledby="scanner-title"><button class="modal-close" id="close-scanner" type="button" aria-label="Fermer">×</button><p class="eyebrow">Open Food Facts</p><h2 id="scanner-title">Scannez un produit</h2><div id="reader"><div class="scanner-placeholder">Caméra prête<br><span>Autorisez l'accès pour commencer</span></div></div><p class="scanner-status" id="scanner-status">Pointez le code-barres dans le cadre.</p></div></div>
  <script src="https://unpkg.com/html5-qrcode" defer></script><script src="assets/js/app.js?v=20260922-1" defer></script>
</body>
</html>
