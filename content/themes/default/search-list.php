<?php include('includes/header.php'); ?>

<div class="container search-results">

		
			<h3>Video Search Results <span>for <?= $search_value ?></span></h3>
		
			<div class="masonry extra-videohover">

				<?php include('partials/video-loop.php'); ?>

			</div>



		<?php if(count($users) < 1): ?>
			<h4>No User Search results found for <?= $search_value ?></h4>
		<?php else: ?>
			<h3>User Search Results <span>for <?= $search_value ?></span></h3>

			<div class="masonry extra-videohover">

				<?php include('partials/user-loop.php'); ?>

			</div>
		<?php endif; ?>

</div>



<?php include('includes/footer.php'); ?>