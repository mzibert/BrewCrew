<?php

/*load the HTML head tag: head-utils.php*/
require_once(dirname(dirname(__DIR__)) . "/php/partials/head-utils.php");
?>
<body class="sfooter content-layout">
	<div class="sfooter-content">

		<!-- insert header and navbar -->
		<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/header.php");?>

		<!-- begin main content page layout -->
		<main class="container p-t-nav">

			<div class="container colored" >
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="container" style="margin-top: 30px">
						<div class="col-md-4">
							<form>
								<h3>Log In</h3>
								<label for="Email" class="sr-only">Email </label>
								<input type="email" id="Email" class="form-control" placeholder="Email" required="required" autofocus="autofocus"/>
								<label for="pwd" class="sr-only">Password</label>
								<input type="password" id="pwd1" class="form-control" placeholder="Password" required="required" />
								<div class="checkbox">
									<label>
										<input type="checkbox" value="remember-me"/>Stay Logged</label></div>
								<button class="btn btn-sm btn-primary btn-block" type="submit">Sign in</button>
							</form>
						</div>
					</div>



			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<!-- page content -->
				<div class="jumbotron">
					<div class="container">
						<div class="col-sm-8 col-sm-offset-2">

							<div ng-view></div>
						</div>
					</div>
				</div>

			</div><!--/.row-flex-->
		</main>

	</div><!--/.sfooter-content-->

	<!-- insert footer -->
	<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/footer.php");?>

</body>
