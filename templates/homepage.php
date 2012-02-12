<?php include('head.php'); ?>

<?php foreach ($people as $i => $p): ?>
<?php if ($i % 6 === 0): ?>
<div class="row">
<?php endif ?>
	<div class="person span2">
		<h6><?php echo $p['name'] ?></h6>
		
		<a href='<?php echo $p['url'] ?>'>
			<img src='<?php echo $p['buddyicon'] ?>'>
		</a>
	</div>
<?php if ($i % 6 === 5): ?>
</div>
<?php endif ?>
<?php endforeach ?>

<?php include('foot.php'); ?>