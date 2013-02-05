<?php
class JobProcessorCommand extends CConsoleCommand
{
	private function getJobs() {
		return ScheduledJob::model()->active()->current()->findAll();
	}

	private function RunReport() {
		$criteria= new CDbCriteria();
		$criteria = array(
			'select' => 'count(grade_id) as num_grade, grade_id', 
			'with' => array( 'grade' ),
			'group' => 'grade_id',
		);
		$books = Book::model()->findAll($criteria);

		// initialize report
		$report = array(
        		'data'=> array (
            			array(
                			'label'=> 'Comic Books by Grade',
                			'data'=>array(),
                			'bars'=>array(
						'show'=>true, 
						'align'=>'center',
					),
            			),
			),
        		'options'=>array(
                		'legend'=>array(
                			'show'=>false,
				),
        		),
        		'htmlOptions'=>array(
               			'style'=>'width:200px;height:200px;'
        		)
    		);

		foreach ($books as $book) {
			$report['data'][0]['data'][] = array($book->grade_id,$book->num_grade);
			$report['options']['xaxis']['ticks'][] = array($book->grade_id,$book->grade->name);
		}

		return $report;
	}

	private function SendWishlist() {
		// prepare the email message
		$subject = "Some Gift Ideas";
    		$headers = 'From: My CBDB Admin admin@mycbdb.com' . "\r\n" . 
			'Reply-To: My CBDB Admin admin@mycbdb.com' . "\r\n" . 
			'X-Mailer: PHP/' . phpversion();
		$email = "Here are a few of my gift wishes:\n";
		// build the body of the email
		$wishes = Wish::model()->findAll();
		foreach ($wishes as $w) {
			$email .="\t" . $w->title . "\n";
		}
		
		$email .="Please come to my website to see more about " . 
			"my collection and play some games.";
		Yii::log("My wishlist email message is [" . $email. "]", 
			'info', 'jobprocessor');

		$wishgivers = User::model()->not_admin()->findAll();
		foreach ($wishgivers as $wg) {
			Yii::log("Sending wishlist to " . $wg->username, 
				'info', 'jobprocessor');
    			//mail($email, $subject, $body, $headers);
		}
	}

	public function run($args)
	{
		$jobs = $this->getJobs();
		foreach ($jobs as $job) {
			Yii::log("Running - Job [" . $job->job->name . 
				"] Action [" . $job->job->action . 
				"] Parameters [" . $job->params . 
				"] scheduled for " . $job->scheduled_time, 
				'info', 'jobprocessor');
			$name = $job->job->action;
			$job->started = new CDbExpression('NOW()');
			$job->save();
			$job->output = json_encode($this->$name($job->params));
			$job->completed = new CDbExpression('NOW()');
			$job->save();
		}
	}
}

?>
