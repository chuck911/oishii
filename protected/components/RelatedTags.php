<?php
class RelatedTags extends CWidget {
	public $tag;
	public function run(){
		$items = array();
		foreach($this->tag->related() as $tag){
			if($tag['tagID'] == $this->tag->id) continue;
			$item = array(
				'label'=>$tag['name'],
				'url'=>array('tag/with2tags','tagName1'=>$this->tag->name,'tagName2'=>$tag['name']),
			);
			array_push($items,$item);
		}
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$items,
			//'encodeLabel'=>false,
			'htmlOptions'=>array(
				'class'=>'scroll-pane tag-list',
			),
			'id'=>'related-tags',
		));
	}
}