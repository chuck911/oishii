<?php

class TagController extends CController
{
	
	public function actionBookmark($tagName)
	{
		$tag = Tag::model()->find('name=:name',array(':name'=>$tagName));
		if(!$tag) throw new CHttpException(404,'The requested page does not exist.');
		$page = (int)Yii::app()->request->getParam('page',1);
		$taggings = Tagging::model()->findAll(array(
			'limit'=>20,
			'condition'=>'tagID=:tagID',
			'params'=>array(':tagID'=>$tag->id),
			'offset'=>($page-1)*20,
		));
		$bookmarks = array();
		foreach ($taggings as $tagging) {
			$bookmarks[]=$tagging->bookmark;
		}		
		$this->render('bookmark',array('bookmarks'=>$bookmarks,'tag'=>$tag));
	}
	
	public function actionTest()
	{
		//$dbCriteria = new CDbCriteria;
		print_r(count(Bookmark::with2Tags(3,107)));
		
	}
	
	public function actionWith2tags($tagName1,$tagName2)
	{
		//$tags = explode(':',$tagName);
		$tag1 = Tag::model()->find('name=:name',array(':name'=>$tagName1));
		$tag2 = Tag::model()->find('name=:name',array(':name'=>$tagName2));
		if(!$tag1||!$tag2) throw new CHttpException(404,'The requested page does not exist.');
		$bookmarks = Bookmark::with2Tags($tag1->id,$tag2->id);
		$this->render('bookmark',array('bookmarks'=>$bookmarks,'tag'=>$tag1));
	}
	
}