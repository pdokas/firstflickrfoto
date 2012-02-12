<?php include('head.php'); ?>

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

<?php include('foot.php'); ?>