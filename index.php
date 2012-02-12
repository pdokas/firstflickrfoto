<?php

	require('config.inc');
	require('lib.inc');
	
	if ($_COOKIE['oauth_token']) {
		$token        = $_COOKIE['oauth_token'];
		$token_secret = $_COOKIE['oauth_token_secret'];
		
		$people = array();
		
		$contacts = getContactList();
		
		foreach ($contacts['contacts']['contact'] as $i => $c) {
			$person = array();
			
			$person['nsid'] = $c['nsid'];
			
			# Get name
			if ($c['realname']) {
				$person['displayname'] = "{$c['realname']} ({$c['username']})";
			}
			else {
				$person['displayname'] = {$c['username'];
			}
			
			# Get photostream url
			if ($c['path_alias']) {
				$person['url'] = "http://flickr.com/photos/{$c['path_alias']}/";
			}
			else {
				$person['url'] = "http://flickr.com/photos/{$c['nsid']}/";
			}
			
			# Get buddyicon
			if ($c['iconserver']) {
				$person['buddyicon'] = "http://farm{$c['iconfarm']}.staticflickr.com/{$c['iconserver']}/buddyicons/{$c['nsid']}.jpg";
			}
			else {
				$person['buddyicon'] = 'http://www.flickr.com/images/buddyicon.jpg';
			}
			
			$firstPage = getPhotos('me');
			$lastPage  = getPhotos('me', $firstPage['photos']['pages']);
			
			$people[] = $person;
		}
	}
	else {
		$request = getRequestToken();

		# 
		# Here's the deal. You need a DB table to store (oauth_token, oauth_token_secret) pairs.
		# When exchanging the request token for the access token, you need to sign the request with this token_secret.
		#
		# 	So at exchange time, look up oauth_token_secret by oauth_token
		#		On success, delete that row (as the token will never be used again)
		# 

		var_export($request);
		$nextStep = "http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}";
		// header("Location: http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}");
	}

?>

<pre><?php var_dump($lastPage) ?></pre>

<?php if (count($people)): ?>
<ol>
<?php foreach ($people as $i => $p): ?>
	<li>
		<h2><?php echo $p['displayname'] ?></h2>
		
		<a href='<?php echo $p['url'] ?>'>
			<img src='<?php echo $p['buddyicon'] ?>'>
		</a>
	</li>
<?php endforeach ?>
</ol>
<?php endif ?>

<?php if ($nextStep): ?>
<a href='<?php echo $nextStep; ?>'>Go west, young man</a>
<?php endif ?>
