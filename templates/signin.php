<?php include('head.php'); ?>

<?php if ($nextStep): ?>
<?php var_export($request); ?><br>
<a href='<?php echo $nextStep; ?>'>Go west, young man</a>
<?php endif ?>

<?php include('foot.php'); ?>