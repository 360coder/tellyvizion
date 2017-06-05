<?php foreach($users as $user): ?>


<div class="videohover-bottomgap">
	<article class="block">
		<a class="block-thumbnail" href="<?= ($settings->enable_https) ? secure_url('user') : URL::to('user') ?><?= '/' . $user->username ?>">
			<div class="thumbnail-overlay"></div>
			<img src="<?= Config::get('site.uploads_dir').'/avatars/'.$user->avatar  ?>">
			<div class="details">
			<?php $name = ($user->name) ? $user->name : $user->username ;?>
				<h2><?= $name; ?></h2>
				<span><?= TimeHelper::convert_seconds_to_HMS($user->duration); ?></span>
			</div>
		</a>
		<div class="block-contents">
			<p class="date"><?= $user->email; ?></p>
		</div>
	</article>
</div>
<?php endforeach; ?>