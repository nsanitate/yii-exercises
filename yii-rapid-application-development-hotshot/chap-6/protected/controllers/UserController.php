<?php

class UserController extends Controller
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
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('index', 'view', 'create', 'update', 'delete', 'aclist'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$user=new User('passwordset');
		$person=new Person;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User'], $_POST['Person']))
		{
			$person->attributes=$_POST['Person'];
			if($person->save()) {
				$user->attributes=$_POST['User'];
				$user->person_id = $person->id;
				if($user->save()) 
					$this->redirect(array('view','id'=>$user->id));
			}
		}

		$this->render('create',array(
			'user'=>$user,
			'person'=>$person,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User'], $_POST['Person']))
		{
			$model->attributes=$_POST['User'];
			if ($model->password || $model->password_repeat) 
				$model->scenario = 'passwordset';
			if($model->save()) {
				$model->person->attributes=$_POST['Person'];
				$model->person->save();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
                        'isAdmin'=>Yii::app()->user->checkAccess('admin'),
		));
	}

        public function actionReloadRoles($id)
        {
                if(isset($_GET['ajax'])) {
                        $model=$this->loadModel($id);
                        $this->renderPartial('//includes/role_select',array(
                            'user'=>$model,
                        ), false, true);
                }
                else
                        throw new CHttpException(400,'Invalid request.');
        }

	public function actionRevokeRole($id)
	{
                // request must be made via ajax
                if(isset($_GET['ajax'])) {
			$auth = Yii::app()->authManager;
        		$auth->revoke($_GET['role_name'], $id);
                }
                else
                        throw new CHttpException(400,'Invalid request.');
	}

	public function actionAssignRole($id)
	{
                // request must be made via ajax
                if(isset($_GET['ajax']) && isset($_GET['role'])) {
                        $model=$this->loadModel($id);
      			$auth = Yii::app()->authManager;
        		$auth->assign($_GET['role'], $id, '', '');
			$role=Assignments::model()->find("itemname='" . 
				$_GET['role'] . "'");
                        $this->renderPartial('//includes/role_li',array(
                            'user'=>$model,
                            'assignment'=>$role,
                        ), false, true);
		}
                else
                        throw new CHttpException(400,'Invalid request.');
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
			$this->loadModel($id)->person->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/* 
	 * user autocomplete function 
	 */
	public function actionAclist($term) 
	{
		$results=array();
            	$model = User::model();
            	$criteria = new CDbCriteria();
		$criteria->with = array('person');
            	$names = preg_split('/\W/', $_GET['term'], 2);
		Yii::trace("got names " . print_r($names, true), 'acl');
		if (count($names) == 1) {
            		$criteria->addSearchCondition( 'person.fname', $names[0], true, 'OR');
            		$criteria->addSearchCondition( 'person.lname', $names[0], true, 'OR');
		} else {
            		$criteria->compare('person.fname', $names[0], true);
            		$criteria->compare('person.lname', $names[1], true);
		}
            	foreach($model->findAll($criteria) as $m)
            	{
               		$results[] = array(
				'id' => $m->{'id'},
				'label' => $m->person->{'fname'} . 
					' ' . $m->person->{'lname'}, 
				'value' => $m->person->{'fname'} . 
					' ' . $m->person->{'lname'}, 
			);
            	}
        	echo CJSON::encode($results);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()
			->with('person')
			->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
