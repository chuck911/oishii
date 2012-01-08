<div class="sidebar">
	<h1><?php echo Yii::app()->name ?></h1>
	<div id='stat'>
		<dl class="stat-tags">
			<dd><?php echo CHtml::link('311','#') ?></dd><dt>tags</dt>
		</dl>
		<dl class="stat-links">
			<dd><?php echo CHtml::link('2011',array('/bookmark')) ?></dd><dt>links</dt>
		</dl>
	</div>
	<h2 id="current-tag"><?php echo $tag->name ?></h2>
	<?php $this->widget('RelatedTags',array('tag'=>$tag)) ?>
</div>
<div class="content">
	
	<ul class="bookmark-list">
	<?php foreach ($bookmarks as $bookmark): ?>
		<?php $this->renderPartial('/bookmark/_bookmarkitem',array('bookmark'=>$bookmark)); ?>
	<?php endforeach ?>
	</ul>
	
</div>


