<?php include('head.php'); ?>

<h1>Your Contacts</h1>

<?php foreach ($people as $i => $p): ?>
<?php if ($i % 6 === 0): ?>
<div class='row'>
<?php endif ?>
	<div class='person span2' data-photo-url='<?php echo "{$p['url']}{$p['first_photo']['id']}/" ?>'>
		<div class='photo'>
			<img src='<?php echo "http://farm{$p['first_photo']['farm']}.staticflickr.com/{$p['first_photo']['server']}/{$p['first_photo']['id']}_{$p['first_photo']['secret']}_m.jpg" ?>'>
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