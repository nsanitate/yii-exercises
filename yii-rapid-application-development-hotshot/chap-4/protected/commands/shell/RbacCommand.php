<?php
class RbacCommand extends CConsoleCommand
{
	public function run($args)
	{
		$auth=Yii::app()->authManager;

		$auth->clearAll();
	 
		// user actions
		$auth->createOperation('UserIndex','index of users');
		$auth->createOperation('UserCreate','create a user');
		$auth->createOperation('UserView','read a user');
		$auth->createOperation('UserUpdate','update a user');
		$auth->createOperation('UserDelete','delete a user');
		$auth->createOperation('UserAclist','autocomplete list for user');
		
		// book actions
		$auth->createOperation('BookAdmin','admin access to books');
		$auth->createOperation('BookIndex','index of books');
		$auth->createOperation('BookCreate','create a book');
		$auth->createOperation('BookView','read a book');
		$auth->createOperation('BookUpdate','update a book');
		$auth->createOperation('BookDelete','delete a book');
		$auth->createOperation('BookRemoveAuthor','remove an author from a book');
		$auth->createOperation('BookCreateAuthor','create an author for a book');

		// publisher actions
		$auth->createOperation('PublisherAdmin','admin access to publishers');
		$auth->createOperation('PublisherIndex','index of publishers');
		$auth->createOperation('PublisherCreate','create a publisher');
		$auth->createOperation('PublisherView','read a publisher');
		$auth->createOperation('PublisherUpdate','update a publisher');
		$auth->createOperation('PublisherDelete','delete a publisher');

		// wish actions
		$auth->createOperation('WishAdmin','admin access to wishes');
		$auth->createOperation('WishIndex','index of wishes');
		$auth->createOperation('WishCreate','create a wish');
		$auth->createOperation('WishView','read a wish');
		$auth->createOperation('WishUpdate','update a wish');
		$auth->createOperation('WishDelete','delete a wish');
		$auth->createOperation('WishClaim','claim a wish');
		$auth->createOperation('WishRemoveAuthor','remove an author from a wish');
		$auth->createOperation('WishCreateAuthor','create an author for a wish');

		// library actions
		$auth->createOperation('LibraryIndex','index of library');
		$auth->createOperation('LibraryRequest','request item from library');
		$auth->createOperation('LibraryLend','lend item from library, and remove request');
		 
		// user task of updating own entry
		$bizRule='return (Yii::app()->user->id==Yii::app()->getRequest()->getQuery(\'id\') || Yii::app()->user->id == $params[\'id\']);';
		$task=$auth->createTask('UpdateOwnUser','update own user entry',$bizRule);
		$task->addChild('UserUpdate');
		 
		$role=$auth->createRole('wishlistAccess');
		$role->addChild('WishIndex');
		$role->addChild('WishView');
		$role->addChild('WishClaim');
		$role->addChild('UpdateOwnUser');
		 
		$role=$auth->createRole('viewer');
		$role->addChild('wishlistAccess');
		$role->addChild('BookIndex');
		$role->addChild('BookView');
		 
		$role=$auth->createRole('borrower');
		$role->addChild('viewer');
		$role->addChild('LibraryIndex');
		$role->addChild('LibraryRequest');
		 
		$role=$auth->createRole('admin');
		$role->addChild('borrower');
		$role->addChild('LibraryLend');

		$task=$auth->createTask('manageWish','manage wish entries');
		$task->addChild('WishCreate');
		$task->addChild('WishUpdate');
		$task->addChild('WishDelete');
		$task->addChild('WishAdmin');
		$task->addChild('WishCreateAuthor');
		$task->addChild('WishRemoveAuthor');
		$role->addChild('manageWish');

		$task=$auth->createTask('manageUser','manage user entries');
		$task->addChild('UserIndex');
		$task->addChild('UserCreate');
		$task->addChild('UserView');
		$task->addChild('UserUpdate');
		$task->addChild('UserDelete');
		$task->addChild('UserAclist');
		$role->addChild('manageUser');

		$task=$auth->createTask('manageBook','manage book entries');
		$task->addChild('BookAdmin');
		$task->addChild('BookCreate');
		$task->addChild('BookUpdate');
		$task->addChild('BookDelete');
		$task->addChild('BookCreateAuthor');
		$task->addChild('BookRemoveAuthor');
		$role->addChild('manageBook');

		$task=$auth->createTask('managePublisher','manage publisher entries');
		$task->addChild('PublisherAdmin');
		$task->addChild('PublisherIndex');
		$task->addChild('PublisherView');
		$task->addChild('PublisherCreate');
		$task->addChild('PublisherUpdate');
		$task->addChild('PublisherDelete');
		$role->addChild('managePublisher');
		 
		$auth->assign('wishlistAccess',54);
		$auth->assign('viewer',53);
		$auth->assign('borrower',52);
		$auth->assign('admin',1);

		echo "Rbac initialized.\n";
	}
}

?>
