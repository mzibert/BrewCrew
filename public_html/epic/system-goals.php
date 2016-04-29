<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>System Goals</title>
	</head>
	<body>
		<header>
			<h1>System Goals</h1>
		</header>
		<main>
			<p><strong>The system goals for this webapp are as follows:</strong></p>
			<ul>
				<li>Allow users to generate a taste profile by rating beers</li>
				<li>Allow users to locate beers of a similar taste profile by using the beer compass (described below)</li>
				<li>Allow users to rate beers on a five-point scale</li>
				<li>Allow users to tag beers with associated flavor tags</li>
				<li>Allow users to add an optional text review to their beer rating</li>
				<li>Allow users to search for beers by style, color, geolocation and rating</li>
				<li>Allow users to locate breweries</li>
				<li>Allow administrators(brewmasters) to hide out of season selections or other limited time on-tap drafts</li>
			</ul>
			<br>
			<p><strong>Definition of the Beer Compass:</strong></p>
			<p>The beer compass is a matrix that utilizes two axes to categorize beer, and allows beers to be associated within general taste profiles based on coordinate location.</p>
			<p>The x axis will be hoppy versus malty, using IBU as a quantitative scale.  The y axis will be color of beer, light to dark, mapped from 0 to 1 based on perceived color associated with style.</p>
			<p>A flavor recommendation will take the following into consideration in this order:
				<ol>
					<li>Color</li>
					<li>IBU</li>
				</ol>
				Once a user has rated 6 beers, a flavor profile will be generated for their user account, and beers similar to those they have already rated highly will be recommended.</p>
		</main>
	</body>
</html>