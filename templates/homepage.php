<?php include('head.php'); ?>

<?php foreach ($people as $i => $p): ?>
<?php if ($i % 6): ?>
<div class="row">
<?php endif ?>
	<div class="span2">
		<h2><?php echo $p['displayname'] ?></h2>
		
		<a href='<?php echo $p['url'] ?>'>
			<img src='<?php echo $p['buddyicon'] ?>'>
		</a>
	</div>
<?php if ($i % 6): ?>
</div>
<?php endif ?>
<?php endforeach ?>

<?php include('foot.php'); ?>