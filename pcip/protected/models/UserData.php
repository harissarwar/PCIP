<?php

/**
 * This is the model class for table "{{user_data}}".
 *
 * The followings are the available columns in table '{{user_data}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $seat
 * @property string $layer
 * @property string $tag
 * @property string $value
 */
class UserData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserData the static model class
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
		return '{{user_data}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, seat, layer, tag, value', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('seat, layer', 'length', 'max'=>32),
			array('tag', 'length', 'max'=>128),
			array('value', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, seat, layer, tag, value', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'seat' => 'Seat',
			'layer' => 'Layer',
			'tag' => 'Tag',
			'value' => 'Value',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('seat',$this->seat,true);
		$criteria->compare('layer',$this->layer,true);
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function seats()
	{
	  $arr = array();
	  for ($i=1; $i<=256; $i++)
      array_push($arr, array('seat' => "na".$i));
    return $arr;
	}
	
	public function data($layer)
	{
    return Yii::app()->db->createCommand()
    ->select('id, seat, tag, value')//desc
    ->from('tbl_user_data')
    ->where('user_id=:id AND layer=:layer', array(':id'=>Yii::app()->user->id, ':layer'=>$layer))
    ->order('id DESC')
    ->queryAll(true);		
	}
}