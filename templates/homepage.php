<?php include('head.php'); ?>

<h1>Your Contacts</h1>

<?php foreach ($people as $i => $p): ?>
<?php if ($i % 6 === 0): ?>
<div class='row'>
<?php endif ?>
	<div class='person span2'>
		<div class='photo'>
			<img src='http://farm<?php echo $p['first_photo']['farm'] ?>.staticflickr.com/<?php echo $p['first_photo']['server'] ?>/<?php echo $p['first_photo']['id'] ?>_<?php echo $p['first_photo']['secret'] ?>_m.jpg'>
		</div>
		<div class='nametag'>
			<a href='<?php echo $p['url'] ?>'>
				<img src='<?php echo $p['buddyicon'] ?>'>
				<h6><?php echo $p['name'] ?></h6>
			</a>
		</div>
	</div>
<?php if ($i % 6 === 5): ?>
</div>
<?php endif ?>
<?php endforeach ?>

<?php include('foot.php'); ?>