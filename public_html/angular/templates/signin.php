
<form>
<div class="container colored" id="signin" >
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form role="form" name="userSignInForm"  id="userSignInForm"   class="form-horizontal well" ng-submit="login("signInData, userSignInFor.$valid);" novalidate>
				<h2>Log In</h2>
				<label for="text" class="sr-only">Username</label>
				<input type="text" id="userId" ng-model="signInData.userUserName" class="form-control" placeholder="username" required="required" autofocus="autofocus"/>
				<label for="password">Password</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key"></i>
					</div>

					<input type="password" id="password" name="password" class="form-control" placeholder="Password" ng-model="signInData.userPassword" ng-minlength="4" ng-maxlength="32" ng-required="true" />
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="signInData.userPassword.$error" ng-if="signInData.userPassword.$touched" ng-hide="signInData.userPassword.$valid">
					<p ng-message="minlength">Password is too short.</p>
					<p ng-message="maxlength">Password is too long.</p>
					<p ng-message="required">Please enter your password.</p>
				</div>
				<h1></h1>
				<button class="btn btn-lg btn-info" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Submit</button>
				<hr />
			</form>
		</div>
	</div>
</div>
	</form>


