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
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li role="presentation" class="active"><a href="home">Home <span class="sr-only">(current)</span></a></li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">The Beer Compass<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li role="presentation"><a href="beer"> Search Beer</a></li>
							<li role="presentation"><a href="breweries"> Search Breweries</a></li>
							<li role="presentation"><a href="signin">Sign In</a></li>
							<li role="presentation"><a href="signup">Join</a></li>
							<li role="separator" class="divider"></li>

							<li role="presentation"><a href="contact">Contact</a></li>

						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>


			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->

</header>