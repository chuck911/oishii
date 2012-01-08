<li>
	<?php echo CHtml::link($bookmark->title,$bookmark->url,array('class'=>'link')) ?>
	<?php foreach ($bookmark->tags as $tag): ?>
		<a href='<?php echo $this->createUrl('tag/bookmark',array('tagName'=>$tag->name)) ?>' class="tag">
			<span><?php echo $tag->name ?></span>
		</a>
	<?php endforeach ?>
</li>