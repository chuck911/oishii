<?php

class BookmarkController extends CController
{
	
	public function actionImport()
	{
		Yii::import('ext.phpQuery');
		phpQuery::newDocumentFile('./bookmarks/trunkly-20120108.html');
		echo pq('title')->text().' importing...';
		echo '<br/>';
		//echo file_get_contents('./bookmark/trunkly.html');
		$i = 0;
		foreach (pq('a') as $link) {
			$qlink = pq($link);
			$bookmark = new Bookmark;
			$bookmark->url = $qlink->attr('href');
			$bookmark->title = $qlink->text();
			$bookmark->created = date('Y-m-d H:i:s', $qlink->attr('add_date'));
			$bookmark->tagstring = $qlink->attr('tags');
			$bookmark->save();
			$bookmark->attachTags($qlink->attr('tags'));
			print($bookmark->title);
			echo '<br/>';
			//if(++$i>10) return;
		}
	}
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Bookmark', array(
		    'criteria'=>array(
		        //'condition'=>'status=1',
		        'order'=>'created DESC',
		        //'with'=>array('tags'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		$this->render('index',array('bookmarkData'=>$dataProvider));
	}
	
	public function actionAdd()
	{
		$url = Yii::app()->request->getParam('url',false);
		if($url) $bookmark = Bookmark::model()->findByAttributes(array('url'=>$url));
		if(!$bookmark){
			$bookmark = new Bookmark;
			$bookmark->url = $url;
			$bookmark->created = date('Y-m-d H:i:s');
		}
		$bookmark->title = Yii::app()->request->getParam('title',false);
		$tagString = Yii::app()->request->getParam('tags',false);
		$tags = explode(' ',$tagString);
		$bookmark->tagstring = implode(',',$tags);
		if($bookmark->save()) $bookmark->attachTags($tags);
		if( Yii::app()->request->getParam('popup',false) ){
			$this->renderPartial('close');
		}else{
			$this->redirect(array('bookmark/index'));
		}
	}
	
	public function actionAddurl()
	{
		$url = Yii::app()->request->getParam('url',false);
		$title = Yii::app()->request->getParam('title',false);
		$tags = '';
		$saved = false;
		if($url){
			$bookmark = Bookmark::model()->findByAttributes(array('url'=>$url));
			if($bookmark){
				$title = $bookmark->title;
				foreach ($bookmark->tags as $tag){
					$tags .= $tag->name.' ';
				}
			}  
		}
		if($url && !$title && !$saved){
			$title = $this->pageTitle($url);
		}
		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('_bookmark_detail_form',compact('url','title','tags'));
		}else{
			$this->renderPartial('bookmark_detail',compact('url','title','tags'));
		}
	}
	
	private function pageTitle($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$html = curl_exec($ch);
		curl_close($ch);
		if( !$html ) return false;
		if( preg_match("/<title>([^>]*)<\/title>/si", $html, $t))  {
			$title = trim($t[1]);
			if( strtolower(mb_detect_encoding($title,"utf-8, iso-8859-1, gbk"))!="utf-8" ){
				$title = iconv("gbk","utf-8",$title);
			}
			return $title;
		}else{
			return false;
		}
	}
	
	public function actionTest()
	{
		$count = Tag::num();
		var_dump($count);
	}
	
}
