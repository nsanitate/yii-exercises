<?php

class BookController extends BController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'create' 'update' 'admin' and 'delete' actions
				'actions'=>array('create','update','removeAuthor','createAuthor','admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
*/

	public function set_fullname($model) {
		if ($model->borrower_id != null) {
			$model->borrower_fullname = 
				($model->borrower->person->fname ? $model->borrower->person->fname . ' ' : '') . 
				($model->borrower->person->lname ? $model->borrower->person->lname : '') ;
		} 
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->set_fullname($model);
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Book;
		$this->create($model);
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$this->set_fullname($model);
		$this->update($model);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('borrower.person');
		$dataProvider=new CActiveDataProvider('Book', array(
			'criteria' => $criteria,
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'isAdmin'=>Yii::app()->user->checkAccess('admin'),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
                $model=Book::model()->with("authors")->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function saveAssociation($model, $author)
	{
		// record book/author association
		$ba = new BookAuthor;
		$ba->book_id = $model->id;
		$ba->author_id = $author->id;
		$ba->save();
	}
}
