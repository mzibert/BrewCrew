

			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<div class="container" id="signup">
					<div class="row">
						<h1>Sign Up to create your Flavor Profile and write reviews.</h1>
						<br>
						<form role="form" name = "userSignUpForm" ng-submit="sendUserActivationToken(signupData, userSignUpForm.$valid);" id="signup" >

							<div class="col-md-6 col-md-offset-3">
								<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
								<fieldset class="form-group">
									<label for="userFirstName">First Name</label>
									<input type="text" class="form-control" name="userFirstName" id="userFirstName"
											 placeholder="First Name" ng-model="signupData.userFirstName"
											 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userFirstName.$error"
										  ng-if="userSignUpForm.userFirstName.$touched" ng-hide="userSignUpForm.userFirstName.$valid">
										<p ng-messages="minlength">Name is too short.</p>
										<p ng-messages="maxlength">Name is too long.</p>
										<p ng-messages="required">Please enter your first name.</p>
									</div>
								</fieldset>
								<fieldset class="form-group">
									<label for="userLastName">Last Name</label>
									<input type="text" class="form-control" name="userLastName" id="userLastName"
											 placeholder="Last Name" ng-model="signupData.userLastName"
											 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userFirstName.$error"
										  ng-if="userSignUpForm.userLastName.$touched" ng-hide="userSignUpForm.userLastName.$valid">
										<p ng-message="minlength">Name is too short.</p>
										<p ng-message="maxlength">Name is too long.</p>
										<p ng-message="required">Please enter your last name.</p>
									</div>
								</fieldset>
								<fieldset class="form-group">
									<label for="userEmail">Enter Your Email Address</label>
									<input type="email" class="form-control" name="userEmail" id="userEmail"
											 placeholder="email@email.com" ng-model="signupData.userEmail"
											 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userEmail.$error"
										  ng-if="userSignUpForm.userEmail.$touched" ng-hide="userSignUpForm.userEmail.$valid">
										<label for="userEmail">Confirm Email</label>
										<div class="input-group">
											<input type="email" class="form-control" id="InputEmailSecond" name="InputEmailSecond" required>
											<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
										<p ng-message="minlength">Email number is too short.</p>
										<p ng-message="maxlength">Email number is too long.</p>
										<p ng-message="required">Please enter your email address.</p>
									</div>
									<p class="text-danger">This is the email address the activation code will be sent to.</p>
								</fieldset>

								<fieldset class="form-group">
									<label for="password">Password</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-key"></i>
										</div>
										<input type="text" id="password" name="password" class="form-control" placeholder="123456789" ng-model="formData.password" ng-minlength="4" ng-maxlength="32" ng-required="true" />
									</div>
									<div class="form-group">
										<label for="InputPassword">Confirm Password</label>
										<div class="input-group">
											<input type="password" class="form-control" id="InputPasswordSecond" name="InputPasswordSecond" required>
											<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
										</div>
									</div>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.password.$error" ng-if="userSignupForm.password.$touched" ng-hide="userSignUpForm.password.$valid">
										<p ng-message="minlength">Password is too short.</p>
										<p ng-message="maxlength">Password is too long.</p>
										<p ng-message="required">Please enter your password.</p>
									</div>
								</fieldset>

								<fieldset class="form-group">
									<label for="userDateOfBirth">Date of Birth</label>
									<input type="text" class="form-control" name="userDateOfBirth" id="userDateOfBirth"
											 placeholder="6/09/1970" ng-model="signupData.userDateOfBirth"
											 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userDateOfBirth.$error"
										  ng-if="userSignUpForm.userDateOfBirth.$touched" ng-hide="userSignUpForm.userDateOfBirth.$valid">
										<p ng-message="minlength">You must be, at least, 21 years old to join.</p>
										<p ng-message="required">Please enter your date of birth.</p>
									</div>
								</fieldset>
								<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
							</div>
						</form>

