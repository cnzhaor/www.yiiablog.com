<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**	
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }
    
    public static function string2array($tags)
    {
    	return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
        //return explode(',' , trim($tags));
    }
    
    public static function array2string($tags)
    {
    	return implode(',' , $tags);
    }
    
    public static function addTags($tags)
    {
    	if(empty($tags)) return ;
    	
    	foreach ($tags as $name)
    	{
    		$aTag = Tag::find()->where(['name'=>$name])->one();
    		$aTagCount = Tag::find()->where(['name'=>$name])->count();
    		
    		if(!$aTagCount)
    		{
    			$tag = new Tag();
    			$tag->name = $name;
    			$tag->frequency = 1;
    			$tag->save();
    		}
    		else
    		{
    			$aTag->frequency += 1;
    			$aTag->save();
    		}
    	}
    }
    
    public static function removeTags($tags)
    {
    	if(empty($tags)) return ;
    	
    	foreach ($tags as $name)
    	{
    		$aTag = Tag::find()->where(['name'=>$name])->one();
    		$aTagCount = Tag::find()->where(['name'=>$name])->count();
    		
    		if($aTagCount)
    		{
    			if($aTagCount && $aTag->frequency <= 1)
    				$aTag->delete();
    			else
    			{
    				$aTag->frequency -= 1;
    				$aTag->save();
    			}
    		}    		
    	}
    }
    
    public static function updateFrequency($oldTags,$newTags)
    {
    	if(!empty($oldTags) || !empty($newTags))
    	{
    		$oldTags = self::string2array($oldTags);
    		$newTags = self::string2array($newTags);
    		
    		self::addTags(array_values(array_diff($newTags,$oldTags)));
    		self::removeTags(array_values(array_diff($oldTags,$newTags)));
    	}
    }

	/**
	 * 获取标签云相关数据
	 * @param int $limit
	 * @return array
	 */
	public static function findTagWeights($limit=20)
	{
		//将标签分为5个级别
		$tag_size_level = 5;

		//根据频率取出前20个标签
		$models=Tag::find()->orderBy('frequency desc')->limit($limit)->all();
		$total=Tag::find()->limit($limit)->count();

		//每个级别的标签数量
		$stepper=ceil($total/$tag_size_level);

		$tags=array();
		//标签集合根据频率排序后的顺序从1开始
		$counter=1;

		if($total>0)
		{
			foreach ($models as $model)
			{
				//每个标签的权重
				$weight=ceil($counter/$stepper)+1;
				//标签名为数组下标,权重为值
				$tags[$model->name]=$weight;
				$counter++;
			}
			//根据键值排列数组
			ksort($tags);
		}
		return $tags;
	}
}
