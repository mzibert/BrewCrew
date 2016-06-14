

<div class="container colored" id="signin" >
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form role="form" name="userSignInForm" ng-submit="login(signInData);" id="userSignInForm" >
				<h2>Log In</h2>
				<label for="text" class="sr-only">Username</label>
				<input type="text" id="userId" ng-model="signInData.userUserName" class="form-control" placeholder="username" required="required" autofocus="autofocus"/>
				<label for="pwd" class="sr-only">Password</label>
				<input type="password" id="password" ng-model="signInData.password" class="form-control" placeholder="Password" required="required" />
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"/>Stay Logged</label></div>
				<button class="btn btn-sm btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
	</div>
</div>


