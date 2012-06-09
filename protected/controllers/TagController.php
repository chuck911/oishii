<?php

class TagController extends CController
{
	
	public function actionBookmark($tagName)
	{
		$tag = Tag::model()->find('name=:name',array(':name'=>$tagName));
		if(!$tag) throw new CHttpException(404,'The requested page does not exist.');
		$dataProvider=new CActiveDataProvider('Tagging',array(
			'criteria'=>array(
				'order'=>'t.id desc',
				'condition'=>'tagID=:tagID',
				'params'=>array(':tagID'=>$tag->id),
				'with'=>array('bookmark'),
			),
		));
		$this->render('bookmark',array('dataProvider'=>$dataProvider,'tag'=>$tag));
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
		$this->render('2tagbookmark',array('bookmarks'=>$bookmarks,'tag'=>$tag1));
	}
	
}