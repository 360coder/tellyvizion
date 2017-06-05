<?php include('includes/header.php'); ?>
<div class="container">
<h4 class="subheadline">Test</h4>
	<form action="<?=url()?>/test" enctype="multipart/form-data" method="POST" accept-charset="UTF-8">
		<input type="file" name="image">
		<input type="submit" name="submit">
	</form>
</div>
<?php include('includes/footer.php'); ?>