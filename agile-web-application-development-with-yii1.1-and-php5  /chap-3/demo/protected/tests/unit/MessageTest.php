<?php
Yii::import('application.controllers.MessageController');
class MessageTest extends CTestCase
{  
	
	public function testRepeat()
	{
	       $message = new MessageController('messageTest'); 
	       $this->assertEquals($message->repeat("Any One Out There?"), "Any One Out There?");
	}
		
}
