

			<!-- begin main content area -->
			<div class="row row-flex content-wrap">

				<div class="container" id="signup" ng-controller="SignupController">

					<div class="row">
						<h1>Sign Up to create your Flavor Profile and write reviews.</h1>
						<br>
						<form role="form" name="userSignUpForm" ng-submit="sendActivationToken(signupData, userSignUpForm.$valid);" id="userSignUpForm" >

							<div class="col-md-6 col-md-offset-3">

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
										</fieldset>


										<fieldset class="form-group">
											<label for="userUserName">Enter Your Username</label>
											<input type="text" class="form-control" name="userUserName" id="userUserName"
													  ng-model="signupData.userUserName"
													 ng-minlength="2" ng-maxlength="12" ng-required="true"/>
											<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userUserName.$error"
												  ng-if="userSignUpForm.userUserName.$touched" ng-hide="userSignUpForm.userUserName.$valid">
										</fieldset>



								<fieldset class="form-group">
									<label for="password">Password</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-key"></i>
										</div>
										<input type="password" id="password" name="password" class="form-control" placeholder="123456789" ng-model="signupData.password" ng-minlength="4" ng-maxlength="32" ng-required="true" />
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
											 placeholder="YYYY-MM-DD" ng-model="signupData.userDateOfBirth"
											 ng-minlength="2" ng-maxlength="128" ng-required="true"/>
									<div class="alert alert-danger" role="alert" ng-messages="userSignUpForm.userDateOfBirth.$error"
										  ng-if="userSignUpForm.userDateOfBirth.$touched" ng-hide="userSignUpForm.userDateOfBirth.$valid">
										<p ng-message="minlength">You must be, at least, 21 years old to join.</p>
										<p ng-message="required">Please enter your date of birth.</p>
									</div>
								</fieldset>
								<br>
								<hr>
								<!-- Submit Form or Reset Form -->
								<p>When you submit this form this user will receive an email from Craft Beer Compass with an activation link.</p>
								<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
								<button class="btn btn-info" type="reset"><i class="fa fa-ban"></i>Reset Form</button>
						</form>
						<br>
						<div class="col-md-6">
							<div class="button-container">
								<a href="profile.php/" class="btn btn-warning">Profile</a>
							</div>
						</div>
