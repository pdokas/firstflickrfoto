<?php

	require('config.inc');
	require('lib.inc');
	
	if ($_COOKIE['oauth_token']) {
		$token        = $_COOKIE['oauth_token'];
		$token_secret = $_COOKIE['oauth_token_secret'];
		
		$contacts = getContactList();
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

<?php if ($nextStep): ?>
<a href='<?php echo $nextStep; ?>'>Go west, young man</a>
<?php endif ?>

<?php if ($contacts): ?>
<ol>
<?php foreach ($contacts['contacts']['contact'] as $i => $c): ?>
	<li>
		<?php if ($c['realname']): ?>
		<h2><?php echo $c['realname'] ?> (<?php echo $c['username'] ?>)</h2>
		<?php else: ?>
		<h2><?php echo $c['username'] ?></h2>
		<?php endif ?>
		
		<?php if ($c['iconserver']): ?>
		<img src='http://farm<?php echo $c['iconfarm'] ?>.staticflickr.com/<?php echo $c['iconserver'] ?>/buddyicons/<?php echo $c['nsid'] ?>.jpg'>
		<?php else: ?>
		<img src='http://www.flickr.com/images/buddyicon.jpg'>
		<?php endif ?>
	</li>
<?php endforeach ?>
</ol>
<pre><?php var_dump($contacts) ?></pre>
<?php endif ?>