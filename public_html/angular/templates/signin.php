

<div class="container colored" id="signin" >
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

		<div class="col-md-4"></div>
		<div class="col-md-4">

		<h1>Hi {{vm.user.firstName}}!</h1>
		<p>You're logged in!!</p>
		<h3>All registered users:</h3>
		<ul>
			<li ng-repeat="user in vm.allUsers">
				{{user.username}} ({{user.firstName}} {{user.lastName}})
				- <a href="#" ng-click="vm.deleteUser(user.id)">Delete</a>
			</li>
		</ul>
		<p>&nbsp;</p>
		<p><a href="/signin/" class="btn btn-primary">Logout</a></p>
		<
	</div>



