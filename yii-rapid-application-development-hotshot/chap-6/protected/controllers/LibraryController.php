<?php

class LibraryController extends Controller
{

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
			array('allow',  // allow all users to perform 'index' action
				'actions'=>array('index', 'request', 'lend'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
*/

	/**
	 * Display library
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition('lendable = 1');
                $dataProvider=new CActiveDataProvider('Book', array(
			'criteria' => $criteria,
		));
                $this->render('index',array(
                        'dataProvider'=>$dataProvider,
                ));
	}

	public function actionRequest($id)
	{
		$request = new Request();
                $request->book_id = $id;
                $request->requester_id = Yii::app()->user->getId();
                $request->save();
		Yii::app()->user->setFlash('success', "Your book request has been submitted.");
                $this->redirect(array('index'));
	}

	public function actionLend($book_id, $user_id) 
	{
		$model=Book::model()->findByPk($book_id);
                if($model===null)
                        throw new CHttpException(404,'The requested book does not exist.');
		$request = Request::model()->find(
			'book_id=:book_id AND requester_id=:user_id', array(
				':book_id' => $book_id,
				':user_id' => $user_id,
			));
                if($request===null)
                        throw new CHttpException(404,'The request does not exist.');

		$request->delete();
		$model->borrower_id = $user_id;
		$model->save();
                $this->redirect(array('book/index'));
	}
}

