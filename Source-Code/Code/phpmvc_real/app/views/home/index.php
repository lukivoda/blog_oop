<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Website</title>

		<link rel="stylesheet" href="{{ ASSET_ROOT }}/css/global.css">
	</head>
	<body>
		<div class="content">
			<header class="main">
				<h1>Welcome to the home/index view</h1>
			</header>

			<p>Below is an example of how you pass parameters into the application.</p>

			<code>/home/index/[name]/[mood]</code>

			<p>{{ name }} is {{ mood }}</p>
		</div>
	</body>
</html>