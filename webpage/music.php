<?php
$playlist = (isset($_REQUEST["playlist"])) ? $_REQUEST["playlist"] : NULL;
$shuffle = (isset($_REQUEST["shuffle"])) ? $_REQUEST["shuffle"] : NULL;
function calc($num)
{
	if ($num > 0 && $num < 1024) {

		return $num . " b";
	} elseif ($num > 1023 && $num < 1048576) {
		return round($num / 1024, 2) . " kb";
	} elseif ($num > 1048575) {
		return round($num / 1048576, 2) . " mb";
	}
}
?>
<? include('header.php'); ?>
<div id="listarea">
	<ul id="musiclist">
		<?php
		if ($playlist) {
			$songs = file("songs/$playlist", FILE_IGNORE_NEW_LINES);
		} elseif ($shuffle) {
			$songs = glob("songs/*.mp3");
			shuffle($songs);
		} else {
			$songs = glob("songs/*.mp3");
		}
		foreach ($songs as $item) {

			if (strstr($item, ".mp3")) {
		?>
				<li class="mp3item"><a href="<?= $item ?> "> <?= basename($item) ?></a> (<?= calc(filesize("songs/" . basename($item))) ?>)</li>

			<?php }
		}

		$list = glob("songs/*.m3u");
		if (!$playlist) {
			foreach ($list as $item) {
			?>
				<li class="playlistitem"><a href="music.php?playlist=<?= basename($item) ?>"> <?= basename($item) ?> </a> </li>

		<?php }
		} ?>
	</ul>
</div>
</body>

</html>