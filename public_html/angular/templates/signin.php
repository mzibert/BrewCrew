<div class="container colored" id="signin">
	<div class="row">
		<br>
		<div class="col-md-4 col-md-offset-4">
			<form role="form" name="userSignInForm" id="userSignInForm" class="form-horizontal well"
					ng-submit="signin(signInData, userSignInForm.$valid);" novalidate>
				<h2>Log In</h2>

				<label for="text" class="sr-only">Username</label>

				<input type="text" id="userName" ng-model="signInData.userName" class="form-control" placeholder="username"
						 required="required" autofocus="autofocus"/>

				<br>
				<label for="password">Password</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key"></i>
					</div>

					<input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="Password"
							 ng-model="signInData.userPassword" ng-minlength="4" ng-maxlength="32" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="userSignInForm.password.$error"
					  ng-if="userSignInForm.password.$touched" ng-hide="userSignInForm.password.$valid">
					<p ng-message="minlength">Password is too short.</p>
					<p ng-message="maxlength">Password is too long.</p>
					<p ng-message="required">Please enter your password.</p>
				</div>
				<h1></h1>
				<button class="btn btn-lg btn-info" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Submit</button>
			</form>
		</div>
	</div>
</div>




