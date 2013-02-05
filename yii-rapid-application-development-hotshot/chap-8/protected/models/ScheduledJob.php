<?php

/**
 * This is the model class for table "scheduled_job".
 *
 * The followings are the available columns in table 'scheduled_job':
 * @property string $id
 * @property string $params
 * @property string $output
 * @property string $job_id
 * @property string $scheduled_time
 * @property string $started
 * @property string $completed
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Job $job
 */
class ScheduledJob extends CActiveRecord
{
	public $job_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ScheduledJob the static model class
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
		return 'scheduled_job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_id', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('job_id', 'length', 'max'=>10),
			array('params, output, scheduled_time, started, completed', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, params, output, job_id, scheduled_time, started, completed, active', 'safe', 'on'=>'search'),
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
			'job' => array(self::BELONGS_TO, 'Job', 'job_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'params' => 'Params',
			'output' => 'Output',
			'job_id' => 'Job',
			'scheduled_time' => 'Scheduled Time',
			'started' => 'Started',
			'completed' => 'Completed',
			'active' => 'Active',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('output',$this->output,true);
		$criteria->compare('job_id',$this->job_id,true);
		$criteria->compare('scheduled_time',$this->scheduled_time,true);
		$criteria->compare('started',$this->started,true);
		$criteria->compare('completed',$this->completed,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function scopes()
	{
		return array(
			'active' => array(
				'condition' => 'active=1 AND completed IS NULL',
			),
			'current' => array(
				'condition' => 'scheduled_time < now()',
			),
		);
	}
}
