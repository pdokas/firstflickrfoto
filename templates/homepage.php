<?php include('head.php'); ?>

<h1>Your Contacts</h1>

<?php foreach ($people as $i => $p): ?>
<?php if ($i % 6 === 0): ?>
<div class='row'>
<?php endif ?>
	<div class='person span2'>
		<div class='photo' data-nsid='<?php echo "{$p['nsid']}" ?>' data-person-url='<?php echo "{$p['url']}" ?>'></div>
		<div class='nametag'>
			<img src='<?php echo $p['buddyicon'] ?>'>
			<h6><?php echo $p['name'] ?></h6>
		</div>
	</div>
<?php if ($i % 6 === 5): ?>
</div>
<?php endif ?>
<?php endforeach ?>

<?php include('foot.php'); ?>