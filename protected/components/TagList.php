<?php

class TagList extends CWidget
{
	public function run()
	{
		$tags = Tag::model()->findAll();
		$items = array();
		foreach($tags as $tag){
			$item = array(
				'label'=>$tag->name,
				'url'=>array('tag/bookmark','tagName'=>$tag->name),
			);
			array_push($items,$item);
		}
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$items,
			//'encodeLabel'=>false,
			'htmlOptions'=>array(
				'class'=>'scroll-pane tag-list',
			),
			'id'=>'tag-list',
		));
	}
}
