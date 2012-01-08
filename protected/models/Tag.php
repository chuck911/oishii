<?php

class Tag extends CActiveRecord
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
		return 'tag';
	}
	
	public function relations()
	{
		return array(
			'bookmarks'=>array(self::MANY_MANY, 'Bookmark','tagging(tagID,bookmarkID)'),
			'taggings'=>array(self::HAS_MANY,'Tagging','tagID'),
		);
	}
	
	public static function num()
	{
		$sql = 'SELECT COUNT(*) FROM `tag`';
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
	
	public static function getTagID($tagName)
	{
		$tag = Tag::model()->find('name=:name',array(':name'=>$tagName));
		if($tag){
			return $tag->id;
		}else{
			$tag = new Tag;
			$tag->name = $tagName;
			$tag->save();
			return $tag->id;
		}
	}
	
	public function related()
	{
		$sql = "SELECT DISTINCT  `tagID` , tag.name
		FROM tagging
		INNER JOIN tag ON tagging.tagID = tag.id
		WHERE  `bookmarkID` 
		IN (
		SELECT bookmarkID
		FROM tagging
		WHERE tagID = {$this->id}
		)";
		$related = Yii::app()->db->createCommand($sql)->queryAll();
		return array_diff($related,array($this->id));		
	}
	
}