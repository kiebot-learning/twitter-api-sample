<?php
	require_once('TwitterAPIExchange.php');
	$settings = array(
	    'oauth_access_token' => "193634881-u0OIIR7DczQq7R7CDm5Vi1FqDVO7TjCvkGbftvSx",
	    'oauth_access_token_secret' => "MjazSoEur91DrdZJBUfDVWDbVjbRuCuANO4QlP38Qjcxn",
	    'consumer_key' => "1E3yodLYj0hKPv37hS4JWL4VH",
	    'consumer_secret' => "iwEMupmlDOy76XA440crQu01Jn7Sb6GnOW8t2Lin6nJAzwDXCw"
	);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$screenName = $_POST['screen_name'];
		$count = 5;
		$url = 'https://api.twitter.com/1.1/users/show.json';
		$getfield = '?screen_name='.$screenName;
		$requestMethod = 'GET';

		$twitter = new TwitterAPIExchange($settings);
		$user = $twitter->setGetfield($getfield)
		    ->buildOauth($url, $requestMethod)
		    ->performRequest();
	    $user = json_decode($user);

	    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	    $getfield = '?screen_name='.$screenName.'&count='.$count;
	    $tweets = $twitter->setGetfield($getfield)
		    ->buildOauth($url, $requestMethod)
		    ->performRequest();
	    $tweets = json_decode($tweets);

	    echo "Name: \t<b>".$user->name."</b><br>";
    	echo "Description: \t<b>".$user->description."</b><br>";
    	echo "Tweets:<br><ul>";

	    for ($i = 0; $i < sizeof($tweets); $i++) {
	    	echo "<li>".$tweets[$i]->text."</li>";
	    }
	    echo "</ul>";
	    
	} else {
		echo "<form method='POST'>
				<label>Enter Twitter screen name</label>
				<input type='text' name='screen_name'>
				<input type='submit' value='GET USER DATA'>
			</form>";
	}
?>
<!-- <html>
	<head>
		<title>Twitter API Test</title>
	</head>
	<body>
		<div>
			<form method="POST">
				<label>Enter Twitter screen name</label>
				<input type="text" name="screen_name">
				<button id="getUserDetails">GET USER DATA</button>
			</form>
		</div>
		<div id="userData"></div>
	</body>
</html> -->


