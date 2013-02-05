<?php
/* 
 * BController is a customized controller base class 
 * extended from Controller
 * to provide shared author functions 
 * for controllers of objects that are joined to authors
 */
class BController extends Controller
{
        public function actionCreateAuthor($id) {
                // request must be made via ajax
                if(isset($_GET['ajax']) && isset($_GET['Person'])) {
                        $model=$this->loadModel($id);
                        $author = new Person();
                        $author->attributes=$_GET['Person'];
                        if (($author->fname != null) &&
                            ($author->lname !=null) )
                        {
                                $model->addAuthor($author);
                                $this->renderPartial('//includes/_li',array(
                                        'model'=>$model,
                                        'author'=>$author,
                                ), false, true);
                        }
                }
                else
                        throw new CHttpException(400,'Invalid request.');
        }

        protected function createAuthor($book) {
                $author = new Person();

                if(isset($_POST['Person'])) {
                        $author->attributes=$_POST['Person'];
                        if ($book->addAuthor($author)) {
                                Yii::app()->user->setFlash('authorAdded',
                                        "Added author " . $author->fname .
                                        " " . $author->lname);
                                $this->redirect(array('update','id'=>$model->id));
                        }
                }
                return $author;
        }

        public function actionRemoveAuthor($id) {
                // request must be made via ajax
                if(isset($_GET['ajax'])) {
                        $model=$this->loadModel($id);
                        $model->removeAuthor($_GET['author_id']);
                }
                else
                        throw new CHttpException(400,'Invalid request.');
        }

        /**
         * Takes the object model, creates an author
	 * if form values are present, saves and redirects to view
	 * otherwise, renders create view
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function create($model)
        {
                $author= $this->createAuthor($model);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

		// get object name from model
		$objName = ucfirst($model->tableName());

                if(isset($_POST[$objName]))
                {
                        $model->attributes=$_POST[$objName];
                        if($model->save()) {
				$this->saveAssociation($model, $author);

                                $this->redirect(array('view','id'=>$model->id));
                        }
                }

                $this->render('create',array(
                        'model'=>$model,
                        'author'=>$author,
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
                $author= $this->createAuthor($model);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

		// get object name from model
		$objName = ucfirst($model->tableName());

                if(isset($_POST[$objName]))
                {
                        $model->attributes=$_POST[$objName];
                        if($model->save())
                                $this->redirect(array('view','id'=>$model->id));
                }

                $this->render('update',array(
                        'model'=>$model,
                        'author'=>$author,
                ));
        }

}
