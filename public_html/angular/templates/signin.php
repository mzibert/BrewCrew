

<div class="container colored" id="signin" >
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="container">
			<div class="col-md-4">
				<form role="form" name="userSignInForm" ng-submit="userName(signinData, userSignInForm.$valid);" id="userSignInForm" >
					<h3>Log In</h3>
					<label for="text" class="sr-only">Username</label>
					<input type="text" id="userId" class="form-control" placeholder="userId" required="required" autofocus="autofocus"/>
					<label for="pwd" class="sr-only">Password</label>
					<input type="password" id="password" class="form-control" placeholder="Password" required="required" />
					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me"/>Stay Logged</label></div>
					<button class="btn btn-sm btn-primary btn-block" type="submit">Sign in</button>
				</form>
			</div>
		</div>


