<header ng-controller="navController">

	<bootstrap-breakpoint></bootstrap-breakpoint>

	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" ng-click="navCollapsed = !navCollapsed">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index">ABQ Brew Crew</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="home">The Compass <span class="sr-only"></span></a></li>
					<li class="active"><a href="beer">Beers <span class="sr-only"></span></a></li>
					<li class="active"><a href="breweries">Breweries <span class="sr-only"></span></a></li>
				</ul>
			<div class="container">
				<button type="button" class="btn btn-signup" data-toggle="modal" data-target="modal-signup">Sign Up</button>
				<div class="modal-fade" id="modal-signup">
					<div class="modal-dialog modal-signup">
						<div class="modal-content">
							<div class="modal-header">
								<h2 class="modal-header">Register</h2>
							</div>
							<div class="modal-body">


								<!-- begin registration area -->
								<div class="row row-flex content-wrap">

									<div class="container">
										<div class="row">
											<form role="form" name="signup" id="signup" ng-controller="SignupController" ng-submit="submit(formData, sampleForm, $valid)">
												<div class="col-lg-6">
													<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
													<div class="form-group">
														<label for="InputName">Name</label>
														<div class="input-group">
															<input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Name" required>
															<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
														</div>
													</div>
													<div class="form-group">
														<label for="InputEmail">Email</label>
														<div class="input-group">
															<input type="email" class="form-control" id="InputEmailFirst" name="InputEmailFirst" placeholder="Enter Email" required>
															<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
														</div>
													</div>
													<div class="form-group">
														<label for="InputEmail">Email</label>
														<div class="input-group">
															<input type="email" class="form-control" id="InputEmailSecond" name="InputEmailSecond" placeholder="Confirm Email" required>
															<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
														</div>
													</div>
													<div class="form-group">
														<label for="InputPassword">Password</label>
														<div class="input-group">
															<input type="password" class="form-control" id="InputPasswordFirst" name="InputPasswordFirst" placeholder="Enter Password" required>
															<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
														</div>
													</div>
													<div class="form-group">
														<label for="InputPassword">Confirm Password</label>
														<div class="input-group">
															<input type="password" class="form-control" id="InputPasswordSecond" name="InputPasswordSecond" placeholder="Confirm Password" required>
															<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
														</div>
													</div>
													<div class="form-group">
														<label>Date of Birth</label>
														<input type="date" class="form-control" id="exampleInputDOB1" placeholder="Date of Birth">
													</div>
													<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
												</div>
											</form>
											<div class="col-lg-5 col-md-push-1">
												<div class="col-md-12">
													<div class="alert alert-success">
														<strong><span class="glyphicon glyphicon-ok"></span> Success! Message sent.</strong>
													</div>
													<div class="alert alert-danger">
														<span class="glyphicon glyphicon-remove"></span><strong> Error! Please check all page inputs.</strong>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div><!--/.row-flex-->


							</div>
						</div>
					</div>
				</div>
			</div>
	</div><!-- /.navbar -->




<!--					<li class="dropdown">-->
<!--						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">The Beer Compass<span class="caret"></span></a>-->
<!--						<ul class="dropdown-menu">-->
<!--							<li><a href="beer"> Search Beer</a></li>-->
<!--							<li><a href="breweries"> Search Breweries</a></li>-->
<!--							<li><a href="signin">Sign In</a></li>-->
<!--							<li><a href="signup">Join</a></li>-->






		</div><!-- /.container-fluid -->

</header>