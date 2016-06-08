

<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "ABq Brew Crew";
/*load head-utils.php - edit path as needed*/
require_once("php/partials/head-utils.php");
?>


<body class="sfooter" xmlns="http://www.w3.org/1999/html">
	<div class="sfooter-content">

		<!-- header partial gets inserted -->
		<?php require_once("php/partials/header.php"); ?>


			<!-- angular view directive -->
			<div ng-view></div>

	</div>
	<!-- Main jumbotron for a primary marketing message or call to action -->
	<main>

	<div class="jumbotron">
		<div class="container">
			<h1>ABQ Brew Crew!</h1>
			<p>This is a template for a simple marketing or informational website. It includes a large callout called a
				jumbotron and three supporting pieces of content. Use it as a starting point to create something more
				unique.</p>
			<p><a class="btn btn-primary btn-lg" href="#" role="button">Join Us! &raquo;</a></p>
		</div>
	</div>

	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-4">
				<h2>Most Reviewed Beers</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
					condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
					euismod. Donec sed odio dui. </p>
				<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
			</div>
			<div class="col-md-4">
				<h2>Heading....</h2>
				<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
					condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
					euismod. Donec sed odio dui. </p>
				<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
			</div>
			<div class="col-md-4">
				<h2>Most ....</h2>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
					porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
					fermentum massa justo sit amet risus.</p>
				<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
			</div>
		</div>

		<hr>
		<div class="container well-lg" id="beercompass">
			<p>BEER COMPASS</p>
		</div>
	</div>
	</main>
	<br><br>
	<hr>
	<br>
	<h2 class="heading h-section text-center" data-barley="index_hiw_heading" data-barley-editor="simple">Here’s how it
		works</h2>
<div class="container">
			<div class="row col-md-4">


							<img src="image/beer1.jpg" alt="">

					<h4>1. Join ABQ Beer
						Crew</h4>
					<p>We make it really easy! Sign up in a single step, and it's simple to cancel anytime.</p>
</div>
				<div class="col-md-4">


							<img src="image/beer2.jpg" alt="">

					<h4>2. Create Your
						Flavor Profile</h4>
					<p>Text Text Text</p>
		</div>
				<div class="col-md-4">


							<img src="image/cerveza-buena.jpg" alt="">

					<h4>3. Get
						Recomendations</h4>
					<p>More Text.</p>
	</div>

			<br>
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-xs-8 text-center">
					<a href="#">Start Today</a>
				</div>
			</div>
		</div>


	<!-- footer gets inserted -->
	<?php require_once("php/partials/footer.php"); ?>

	<!-- /.container -->
</div>

</body>
</html>
