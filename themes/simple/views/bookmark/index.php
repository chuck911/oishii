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
	<input type="text" value="" id="tag-filter" placeholder="标签搜索..."/>
	<?php $this->widget('TagList') ?>
</div>
<div class="content">
	<a href="#" id="new-bookmark">+</a>
	<a href="javascript:(function(){h='<?php echo Yii::app()->createAbsoluteUrl('bookmark/addurl') ?>?popup=1&';u=h+'url='+encodeURIComponent(window.location.href)+'&title='+encodeURIComponent(document.title);window.open(u, 'trunk.lyuiv6', 'location=yes,links=no,scrollbars=no,toolbar=no,width=506,height=189')})();" id="bookmarklet" title="Oishii Bookmarklet">Oishii↥</a>
	<div id="new-bookmark-forms" style="display:none;">
		<form id="add-bookmark-url" action="<?php echo $this->createUrl('bookmark/addurl') ?>" method="post">
			<input id="bookmark-url" name="url" type="text" value="http://"/>
			<button type="submit">保存</button>
		</form>
	</div>
	
	<ul class="bookmark-list">
	<?php foreach ($bookmarkData->getData() as $bookmark): ?>
		<?php $this->renderPartial('/bookmark/_bookmarkitem',array('bookmark'=>$bookmark)); ?>
	<?php endforeach ?>
	</ul>
	<?php
	 $this->widget('CLinkPager', array(
			'id'=>'bookmark-pager',
	    'pages' => $bookmarkData->pagination,
			'nextPageLabel'=>'&gt;&gt;',
			'prevPageLabel'=>'&lt;&lt;',
			'header'=>'',
			'maxButtonCount'=>1,
	)) ?>
	
	
</div>


