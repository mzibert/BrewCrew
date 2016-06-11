

			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<div class="container">
					<div class="row">
						<form role="form" name="signup" id="signup" ng-controller="SignupController" ng-submit="submit(formData, sampleForm, $valid)">
							<div class="col-md-6 col-md-offset-3">
								<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
								<div class="form-group">
									<label for="InputName">Name</label>
									<div class="input-group">
										<input type="text" class="form-control" name="InputName" id="InputName" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputEmail">Email</label>
									<div class="input-group">
										<input type="email" class="form-control" id="InputEmailFirst" name="InputEmailFirst" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputEmail">Confirm Email</label>
									<div class="input-group">
										<input type="email" class="form-control" id="InputEmailSecond" name="InputEmailSecond" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputPassword">Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="InputPasswordFirst" name="InputPasswordFirst" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="InputPassword">Confirm Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="InputPasswordSecond" name="InputPasswordSecond" required>
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
<!--						<div class="col-lg-5 col-md-push-1">
							<div class="col-md-12">
								<div class="alert alert-success">
									<strong><span class="glyphicon glyphicon-ok"></span> Success! Message sent.</strong>
								</div>
								<div class="alert alert-danger">
									<span class="glyphicon glyphicon-remove"></span><strong> Error! Please check all page inputs.</strong>
								</div>-->
							</div>
						</div>
					</div>
					</div>




			</div><!--/.row-flex-->

