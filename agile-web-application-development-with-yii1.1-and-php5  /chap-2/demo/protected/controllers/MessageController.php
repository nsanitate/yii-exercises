<?php

class MessageController extends Controller
{
	public function actionHelloWorld()
	{
		$theTime = date("D M j G:i:s T Y");
		$this->render('helloWorld',array('time'=>$theTime)); 
		
	}
	
	public function actionGoodbye()
	{
		$this->render('goodbye'); 
		
	}

	public function actionIndex()
	{
		$this->render('index');
	}

}