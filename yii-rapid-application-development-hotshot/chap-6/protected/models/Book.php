<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property string $id
 * @property string $title
 * @property string $issue_number
 * @property string $type_id
 * @property string $publication_date
 * @property string $value
 * @property string $price
 * @property string $notes
 * @property integer $signed
 * @property string $grade_id
 * @property integer $bagged
 * @property string $borrower_id
 * @property integer $lendable
 *
 * The followings are the available model relations:
 * @property Type $type
 * @property Grade $grade
 * @property Publisher $publisher
 * @property BookAuthor[] $bookauthors
 * @property BookIllustrator[] $bookillustrators
 * @property BookTag[] $booktags
 * @property User[] $requesters
 * @property Request[] $requests
 * @property User $borrower
 */
class Book extends CActiveRecord
{
        public $borrower_fullname = '';
        public $borrower_fname;
        public $borrower_lname;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Book the static model class
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
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('signed, bagged, lendable', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>256),
			array('issue_number', 'length', 'max'=>10),
			array('type_id, value, price, grade_id, borrower_id', 'length', 'max'=>10),
			array('publication_date, notes', 'safe'),
		        array('borrower_id', 'default', 'setOnEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, type_id, publication_date, value, price, notes, signed, grade_id, bagged, issue_number, lendable, borrower_fname, borrower_lname', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'Type', 'type_id'),
			'grade' => array(self::BELONGS_TO, 'Grade', 'grade_id'),
                        'publisher' => array(self::BELONGS_TO, 'Publisher', 
				'publisher_id'),
                        'authors' => array(self::MANY_MANY, 'Person',
                        	'bookauthor(author_id, book_id)', 
				'index'=>'id'),
                        'bookauthors' => array(self::HAS_MANY, 'BookAuthor', 
				'book_id', 'index' => 'author_id'),
                        'illustrators' => array(self::MANY_MANY, 'Person',
                        	'bookillustrator(illustrator_id, book_id)', 
				'index'=>'id'),
                        'bookillustrators' => array(self::HAS_MANY, 
				'BookIllustrator', 'book_id', 
				'index' => 'illustrator_id'),
                        'booktags' => array(self::HAS_MANY, 'BookTag', 
				'book_id'),
			'borrower' => array(self::BELONGS_TO, 'User', 
				'borrower_id'),
                        'requesters' => array(self::MANY_MANY, 'User', 
                        	'request(requester_id, book_id)', 
				'index'=>'id'),
                        'requests' => array(self::HAS_MANY, 'Request', 
				'book_id', 'index' => 'requester_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'type_id' => 'Type',
			'publication_date' => 'Publication Date',
			'value' => 'Value',
			'price' => 'Price',
			'notes' => 'Notes',
			'signed' => 'Signed',
			'grade_id' => 'Grade',
			'bagged' => 'Bagged',
                        'issue_number' => 'Issue Number',
                        'borrower_id' => 'Borrower',
                        'lendable' => 'Lendable',
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

		$criteria->compare('title',$this->title,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('publication_date',$this->publication_date,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('signed',$this->signed);
		$criteria->compare('grade_id',$this->grade_id,true);
		$criteria->compare('bagged',$this->bagged);
		$criteria->compare('issue_number',$this->issue_number,true);
		$criteria->compare('lendable',($this->lendable=="yes" ? 1: 
			($this->lendable=="no" ? 0 : "")),true);
		$criteria->compare('person.fname', $this->borrower_fname, true);
		$criteria->compare('person.lname', $this->borrower_lname, true);
		$criteria->with = array('borrower.person');

                $sort = new CSort;
                $sort->attributes = array(
                        'borrower_fname' => array(
                                'asc' => 'person.fname',
                                'desc' => 'person.fname DESC',
                        ),
                        'borrower_lname' => array(
                                'asc' => 'person.lname',
                                'desc' => 'person.lname DESC',
                        ),
                        '*',
                );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}

	/* returns a string describing lending status */
        public function get_status($data, $row) {
		$status ="";
		if ($data->borrower_id != null) {
			$status = "Checked Out";
		}
		if ($data->borrower_id == Yii::app()->user->getId()) {
			$status = "You Have It";
		}
		return $status;
	}

	/* returns a string list of authors for this book */
        public function author_list($data, $row) {
		$list = '';
		$count = 1;
		foreach ($data->authors as $a) {
			if ($count > 1) {
				$list .= ", ";
			} 
			$list .= $a->fname . ' ' . $a->lname;
			$count++;
		}
		return $list;
	}

        public function requested($row, $data) {
		$me = Yii::app()->user->getId();

		foreach ($data->requesters as $r) {
			if ($r->id == $me) {
				return false;
			}
		}
		if ($data->borrower_id==$me) {
			return false;
		}
		return true;
	}

        /* 
         * assign this author to this book
         */
        public function addAuthor($author) {
                $bookauthor = new BookAuthor();

                $author->save();
                $bookauthor->book_id = $this->id;
                $bookauthor->author_id = $author->id;
                $bookauthor->save();
        }

        /*
         * remove an author association from book
         */
        public function removeAuthor($author_id) {
                $pk = array('book_id'=>$this->id, 'author_id' => $author_id);
                BookAuthor::model()->deleteByPk($pk);
        }
}
