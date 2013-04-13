<?php

/**
 * This is the model class for table "{{layer}}".
 *
 * The followings are the available columns in table '{{layer}}':
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property string $desc
 */
class Layer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Layer the static model class
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
		return '{{layer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, tag', 'required'),
			array('name', 'length', 'max'=>32),
			array('tag', 'length', 'max'=>128),
			array('desc', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, tag, desc', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Layer',
			'tag' => 'Tag',
			'desc' => 'Desc',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('desc',$this->desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function layers()
	{
    return Yii::app()->db->createCommand()
    ->selectDistinct('name')
    ->from('tbl_layer')
    ->queryAll(true);		
	}
	
	public function tags($layer)
	{
    return Yii::app()->db->createCommand()
    ->select('tag')//desc
    ->from('tbl_layer')
    ->where('name=:name', array(':name'=>$layer))
    ->queryAll(true);		
	}
}