<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Conceptual Model</title>
	</head>
	<body>
		<header>
			<h1>Conceptual Model</h1>
		</header>
		<main>
			<h2>Attributes and Entities</h2>
			<!--Full list of attributes and entities-->
			<h4>User</h4>
			<ul>
				<li>userId</li>
				<li>breweryId</li>
				<li>accessLevel</li>
				<li>dateOfBirth</li>
				<li>firstName</li>
				<li>lastName</li>
				<li>userEmail</li>
				<li>username</li>
				<li>userHash</li>
				<li>userSalt</li>
			</ul>
			<h4>Brewery</h4>
			<ul>
				<li>breweryId</li>
				<li>breweryDescription</li>
				<li>breweryEstDate</li>
				<li>breweryHours</li>
				<li>breweryLocation</li>
				<li>breweryPhone</li>
				<li>breweryName</li>
				<li>breweryURL</li>
			</ul>
			<h4>Beer</h4>
			<ul>
				<li>beerId</li>
				<li>breweryId</li>
				<li>tagId</li>
				<li>beerABV</li>
				<li>beerAvailability</li>
				<li>beerAwards</li>
				<li>beerColor</li>
				<li>beerDescription</li>
				<li>beerIBU</li>
				<li>beerName</li>
				<li>beerStyle</li>
			</ul>
			<h4>Review</h4>
			<ul>
				<li>reviewId</li>
				<li>beerId</li>
				<li>userId</li>
				<li>tagId</li>
				<li>pintRating</li>
				<li>reviewDate</li>
				<li>reviewText</li>
			</ul>
			<h4>Tag</h4>
			<ul>
				<li>tagId</li>
				<li>beerId</li>
				<li>tagLabel</li>
			</ul>
			<!--Need to add new beerTag and reviewTag entities and attribs-->

			<h2>Relations</h2>
			<!--Relations in all forms formatted into a table-->
			<table>
				<tr>
					<th>Verbal</th>
					<th>Algebraic</th>
					<th>Description</th>
				</tr>
				<tr>
					<td>user-to-review</td>
					<td>m-to-<i>n</i></td>
					<td>Users can create many reviews/ratings (for different beers).</td>
				</tr>
				<tr>
					<td>brewery-to-beer</td>
					<td>1-to-<i>n</i></td>
					<td>Breweries can have many associated beers.</td>
				</tr>
				<tr>
					<td>beer-to-review</td>
					<td>1-to-<i>n</i></td>
					<td>Beers can have many reviews.</td>
				</tr>
				<tr>
					<td>beer-to-beerTag</td>
					<td>m-to-<i>n</i></td>
					<td>Beers can possess many tags</td>
				</tr>
				<tr>
					<td>review-to-reviewTag</td>
					<td>m-to-<i>n</i></td>
					<td>Reviews can possess many tags.</td>
				</tr>
			</table>
			<br>
			<h2>ERD</h2><!--update with new image when image is complete-->
			<img src="images/brew-crew-erd.svg" alt="ERD for Beer Compass Project">
		</main>
	</body>
</html>
