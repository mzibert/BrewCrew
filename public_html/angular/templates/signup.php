<?php


/*load the HTML head tag: head-utils.php*/
require_once(dirname(dirname(__DIR__)) . "/php/partials/head-utils.php");
?>
<body class="sfooter content-layout">
	<div class="sfooter-content">

		<!-- insert header and navbar -->
		<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/header.php");?>


			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<div class="container">
					<div class="row">
						<form role="form" name="signup" id="signup" ng-controller="SignupController" ng-submit="submit(formData, sampleForm, $valid)">
							<div class="col-lg-6">
								<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
								<div class="form-group">
									<label for="InputName">Enter Name</label>
									<div class="input-group">
										<input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Name" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputEmail">Enter Email</label>
									<div class="input-group">
										<input type="email" class="form-control" id="InputEmailFirst" name="InputEmailFirst" placeholder="Enter Email" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputEmail">Confirm Email</label>
									<div class="input-group">
										<input type="email" class="form-control" id="InputEmailSecond" name="InputEmailSecond" placeholder="Confirm Email" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputPassword">Enter Password</label>
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


	</div><!--/.sfooter-content-->

	<!-- insert footer -->
	<?php require_once(dirname(dirname(__DIR__)) . "/php/partials/footer.php");?>

