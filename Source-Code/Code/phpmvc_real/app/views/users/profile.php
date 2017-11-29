<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>User profile</title>
	</head>
	<body>
		{% if user %}
			<h2>{{ user.username }}'s profile</h2>
			<p>Email: {{ user.email }}</p>
		{% endif %}
	</body>
</html>