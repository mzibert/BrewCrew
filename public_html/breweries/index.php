<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*set page title here*/
$PAGE_TITLE = "Search Breweries";

/*load the HTML head tag: head-utils.php*/
require_once(dirname(__DIR__) . "/php/partials/head-utils.php");
?>
<body class="sfooter content-layout">
	<div class="sfooter-content">

		<!-- insert header and navbar -->

		<?php require_once(dirname(__DIR__) . "/php/partials/header.php");?>

		<!-- begin main content page layout -->
		<main class="container p-t-nav">

			<?php
			/*grab current directory*/
			$CURRENT_DIR = __DIR__;

			/*set page title here*/
			$PAGE_TITLE = "Search Breweries";

			/*load the HTML head tag: head-utils.php*/
			require_once(dirname(__DIR__) . "/php/partials/head-utils.php");
			?>
			<body class="sfooter content-layout">
				<div class="sfooter-content">

					<!-- insert header and navbar -->
					<?php require_once(dirname(__DIR__) . "/php/partials/header.php");?>

					<main class="container p-t-nav">

						<!-- insert the page title up top -->
						<?php require_once(dirname(__DIR__) . "/php/partials/page-title.php");?>

						<!-- begin main content area -->
						<div class="row row-flex content-wrap">

							<!-- page content -->
							<div class="col-sm-9 col-sm-push-3 content-panel">
								<div class="row">
									<div class="col-lg-6">
										<div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
											<input type="text" class="form-control" placeholder="Search for...">
										</div><!-- /input-group -->
									</div><!-- /.col-lg-6 -->

								</div><!-- /input-group -->
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->



				</div><!--/.sfooter-content-->

	<!-- insert footer -->
	<?php require_once(dirname(__DIR__) . "/php/partials/footer.php");?>

</body>
