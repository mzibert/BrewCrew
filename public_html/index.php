<!doctype html>
<html>

/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "ABQ Brew Crew - Home";
/*load the HTML head tag: head-utils.php*/
<?php require_once("php/partials/head-utils.php");?>

	<body class="sfooter">
		<div class="sfooter-content">
			<!-- header partial gets inserted -->
			<?php require_once("php/partials/header.php");?>
			<main>
				<!-- Main jumbotron for a primary marketing message or call to action -->
				<div class="jumbotron">
					<div class="container">
						<h1>ABQ Brew Crew!</h1>
						<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
						<p><a class="btn btn-primary btn-lg" href="#" role="button">Join Us! &raquo;</a></p>
					</div>
				</div>

				<div class="container">
					<!-- Example row of columns -->
					<div class="row">
						<div class="col-md-4">
							<h2>Most Reviewed Beers</h2>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
							<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
						</div>
						<div class="col-md-4">
							<h2>Heading....</h2>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
							<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
						</div>
						<div class="col-md-4">
							<h2>Most ....</h2>
							<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
							<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
						</div>
					</div>

					<hr>
					<div class="container well-lg" id="beercompass">
						<p>BEER COMPASS</p>
						</div>

				</main>
			<br><br><hr><br>
			<h2 class="heading h-section text-center" data-barley="index_hiw_heading" data-barley-editor="simple">Here’s how it works</h2>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="row">
						<section class="box-choose hiw col-sm-4">
							<figure><div data-barley="idx_hiw_step_1_img" data-barley-editor="image" data-width="97" data-height="103"><img src="image/beer1.jpg" alt=""></div></figure>
							<h4 class="subheading" data-barley="idx_hiw_step_1_text" data-barley-editor="simple">1. Join ABQ Beer Crew</h4>
							<p>We make it really easy! Sign up in a single step, and it's simple to cancel anytime.</p>
						</section>
						<section class="box-choose hiw col-sm-4">
							<figure><div data-barley="idx_hiw_step_2_img" data-barley-editor="image" data-width="197" data-height="120"><img src="image/beer2.jpg" alt=""></div></figure>
							<h4 class="subheading" data-barley="idx_hiw_step_2_text" data-barley-editor="simple">2. Create Your Flavor Profile</h4>
							<p>Text Text Text</p>
						</section>
						<section class="box-choose hiw col-sm-4">
							<figure><div data-barley="idx_hiw_step_3_img" data-barley-editor="image" data-width="139" data-height="120"><img src="image/cerveza-buena.jpg" alt=""></div></figure>
							<h4 class="subheading" data-barley="idx_hiw_step_3_text" data-barley-editor="simple">3. Get Recomendations</h4>
							<p>More Text.</p>
						</section>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-xs-8 text-center">
							<a href="#">Start Today</a>
						</div>
					</div>
				</div>
			</div>

			<!-- footer gets inserted -->
			<?php require_once("php/partials/footer.php");?>

				<!-- /.container -->


	</body>
</html>
