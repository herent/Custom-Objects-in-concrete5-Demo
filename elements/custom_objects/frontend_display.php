<?php
defined('C5_EXECUTE') or die("Access Denied.");
$title = $customObject->getTitle();
$content = $customObject->getContent();
?>
<h1><?php echo $title;?></h1>
<div class="content">
	<?php echo $content;?>
</div>