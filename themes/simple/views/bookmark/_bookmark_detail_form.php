<h4>保存书签</h4>
<form id="add-bookmark-detail" action="<?php echo $this->createUrl('bookmark/add') ?>" method="post">
	<label for="bookmark-url">链接</label>
	<input id='bookmark-url' name="url" type="text" value="<?php echo $url ?>"/>
	<label for="bookmark-title">标题</label>
	<input id='bookmark-title' name="title" type="text" value="<?php echo $title ?>"/>
	<label for="bookmark-tags">标签(用空格分隔)</label>
	<input id='bookmark-tags' name="tags" type="text" value="<?php echo $tags ?>"/>
	<?php if(isset($popup)): ?>
		<input type="hidden" name='popup' value="1"/>
	<?php endif ?>
	<button type="submit">保存</button>
</form>