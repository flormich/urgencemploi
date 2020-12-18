<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UrgenEmploi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="UrgenEmploi">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/formulaire.css">
    <link rel="stylesheet" href="../assets/css/readJob.css"> 
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header margin-0">
		<header class="mdl-layout__header bandeau blue">
			<div class="mdl-layout__header-row ">
			<!-- Title -->
				<span class="mdl-layout-title">
					<a class="mdl-navigation__link" href="index"><img src= "../assets/pictures/icones/UrgenceEmploi.jpg" alt="UrgencEmploi" width="25%"></a>
				</span>
				<!-- Add spacer, to align navigation to the right -->


				<div class="mdl-layout-spacer"></div>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
				<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
					mdl-textfield--floating-label mdl-textfield--align-right">
			</div>

			<!-- Navigation. We hide it in small screens. -->
			<nav class="mdl-navigation mdl-layout--large-screen-only">
			<!-- <a class="mdl-navigation__link" href="utilisateur">Utilisateur</a> -->
				<a class="mdl-navigation__link" href="showJob">Voir Offre d'emploi</a>
				<a class="mdl-navigation__link" href="newJob">Créer Offre d'emploi</a>
				<a class="mdl-navigation__link" href="showCv">Voir CV</a>
				<a class="mdl-navigation__link" href="newCv">Créer CV</a>

				<!-- Right aligned menu below button -->
				<button id="demo-menu-lower-right"
					class="mdl-button mdl-js-button mdl-button--icon">
					<i class="material-icons">more_vert</i>
				</button>

				<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="demo-menu-lower-right">
					<a class="mdl-menu__item" href="new">S'inscrire</a>
					<a class="mdl-menu__item" href="login">Se connecter</a>
					<a class="mdl-menu__item" href="logout">Se déconnecter</a>
				</ul>
			</nav>	
		</header>
	</div>
	
	<div class="mdl-layout__drawer">
		<span class="mdl-layout-title">
		</span>
		<nav class="mdl-navigation">
			<a class="mdl-navigation__link" href="index"><img src= "../assets/pictures/icones/UrgenceEmploi.jpg" alt="UrgencEmploi" width="70%"></a>
			<br>
			<a class="mdl-navigation__link" href="showJob">Voir Offre d'emploi</a>
			<a class="mdl-navigation__link" href="newJob">Créer Offre d'emploi</a>
			<a class="mdl-navigation__link" href="showCv">Voir CV</a>
			<a class="mdl-navigation__link" href="newCv">Créer CV</a>
			<br><br>
			<a class="mdl-navigation__link" href="new">S'inscrire</a>
			<a class="mdl-navigation__link" href="login">Se connecter</a>
			<a class="mdl-navigation__link" href="logout">Se déconnecter</a>
		</nav>
	</div>
	<main class="mdl-layout__content">
		<div class="page-content"><!-- Your content goes here -->
