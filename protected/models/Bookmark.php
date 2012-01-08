<?php

class Bookmark extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bookmark';
	}
	
	public function relations()
	{
		return array(
			'tags'=>array(self::MANY_MANY, 'Tag','tagging(bookmarkID,tagID)'),
		);
	}
	
	public static function num()
	{
		$sql = 'SELECT COUNT(*) FROM `bookmark`';
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
	
	public function attachTags($tags)
	{
		if(is_string($tags)){
			$tags = explode(',',$tags);
		}
		//compare new tags to the olds
		foreach($this->tags as $addedTag){
			if($i = array_search($addedTag->name,$tags)){
				unset($tags[$i]);
			}else{
				$this->removeTag($addedTag);
			}
		}
		foreach ($tags as $tagName) {
			if(!$tagName) continue;
			$this->addTag($tagName);
		}
	}
	
	public function addTag($tagName)
	{
		$tagID = Tag::getTagID($tagName);
		$tagging = new Tagging;
		$tagging->tagID = $tagID;
		$tagging->bookmarkID = $this->id;
		return $tagging->save();
	}
	
	public function removeTag($tag)
	{
		if(is_string($tag))
			$tagID = Tag::getTagID($tag);
		else
			$tagID = $tag->id;
		Tagging::model()->deleteAllByAttributes(array('tagID'=>$tagID,'bookmarkID'=>$this->id));
	}
	
	public static function with2Tags($tagID1,$tagID2)
	{
		$sql = "SELECT a.`bookmarkID`
		FROM (
		SELECT `bookmarkID` 
		FROM `tagging` 
		WHERE `tagID` = {$tagID1}
		) AS a
		JOIN (
		SELECT `bookmarkID` 
		FROM `tagging` 
		WHERE `tagID` = {$tagID2}
		) AS b 
		ON a.`bookmarkID` = b.`bookmarkID`";
		//JOIN `bookmark` AS c ON a.bookmarkID = c.id
		$bookmarkIDs = Yii::app()->db->createCommand($sql)->queryColumn();
		$dbCriteria = new CDbCriteria;
		$dbCriteria->addInCondition('id',$bookmarkIDs);
		return Bookmark::model()->findAll($dbCriteria);
	}
}
