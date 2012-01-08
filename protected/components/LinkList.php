<?php
class LinkList extends CMenu {
	public $itemsData = array();
	public $labelKey = 'label';
	public $urlKey = 'url';
	public $urlTemplate = '#';
	
	public function init(){
		foreach ($itemsData as $itemData) {
			if(is_array($this->urlTemplate)&&count($this->urlTemplate)>1){
				$url = array($this->urlTemplate[0],$this->urlTemplate[1]=>$itemData->($this->urlkey))
			}else if{
				$url = $urlTemplate;
			}
			$item = array(
				'label'=>$itemData->$labelKey,
				'url'=>$url,
			);
			array_push($this->items,$item);
		}
		parent::init();
	}
}