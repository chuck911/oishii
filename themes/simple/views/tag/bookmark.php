<div class="sidebar">
	<h1><?php echo CHtml::link(Yii::app()->name,Yii::app()->homeUrl) ?></h1>
	<div id='stat'>
		<dl class="stat-tags">
			<dd><?php echo CHtml::link(Tag::num(),'#') ?></dd><dt>tags</dt>
		</dl>
		<dl class="stat-links">
			<dd><?php echo CHtml::link(Bookmark::num(),array('/bookmark')) ?></dd><dt>links</dt>
		</dl>
	</div>
	<h2 id="current-tag"><?php echo $tag->name ?></h2>
	<?php $this->widget('RelatedTags',array('tag'=>$tag)) ?>
</div>
<div class="content">
	
	<ul class="bookmark-list">
	<?php foreach ($dataProvider->getData() as $tagging): ?>
		<?php $this->renderPartial('/bookmark/_bookmarkitem',array('bookmark'=>$tagging->bookmark)); ?>
	<?php endforeach ?>
	</ul>
	
	<?php
	 $this->widget('CLinkPager', array(
			'id'=>'bookmark-pager',
	    'pages' => $dataProvider->pagination,
			'nextPageLabel'=>'&gt;&gt;',
			'prevPageLabel'=>'&lt;&lt;',
			'header'=>'',
			'maxButtonCount'=>1,
	)) ?>
	
</div>