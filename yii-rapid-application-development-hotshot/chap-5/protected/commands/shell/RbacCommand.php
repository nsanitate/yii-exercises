<?php
class RbacCommand extends CConsoleCommand
{
	public function run($args)
	{
		$auth=Yii::app()->authManager;

		$auth->clearAll();
	 
		// user actions
		$auth->createOperation('indexUser','index of users');
		$auth->createOperation('createUser','create a user');
		$auth->createOperation('viewUser','read a user');
		$auth->createOperation('updateUser','update a user');
		$auth->createOperation('deleteUser','delete a user');
		$auth->createOperation('aclistUser','autocomplete list for user');
		
		// book actions
		$auth->createOperation('adminBook','admin access to books');
		$auth->createOperation('indexBook','index of books');
		$auth->createOperation('createBook','create a book');
		$auth->createOperation('viewBook','read a book');
		$auth->createOperation('updateBook','update a book');
		$auth->createOperation('deleteBook','delete a book');
		$auth->createOperation('removeAuthorBook','remove an author from a book');
		$auth->createOperation('createAuthorBook','create an author for a book');

		// publisher actions
		$auth->createOperation('adminPublisher','admin access to publishers');
		$auth->createOperation('indexPublisher','index of publishers');
		$auth->createOperation('createPublisher','create a publisher');
		$auth->createOperation('viewPublisher','read a publisher');
		$auth->createOperation('updatePublisher','update a publisher');
		$auth->createOperation('deletePublisher','delete a publisher');

		// wish actions
		$auth->createOperation('adminWish','admin access to wishes');
		$auth->createOperation('indexWish','index of wishes');
		$auth->createOperation('createWish','create a wish');
		$auth->createOperation('viewWish','read a wish');
		$auth->createOperation('updateWish','update a wish');
		$auth->createOperation('deleteWish','delete a wish');
		$auth->createOperation('claimWish','claim a wish');
		$auth->createOperation('removeAuthorWish','remove an author from a wish');
		$auth->createOperation('createAuthorWish','create an author for a wish');

		// library actions
		$auth->createOperation('indexLibrary','index of library');
		$auth->createOperation('requestLibrary','request item from library');
		$auth->createOperation('lendLibrary','lend item from library, and remove request');
		 
		// user task of updating own entry
		$bizRule='return Yii::app()->user->id==$params["user"]->authID;';
		$task=$auth->createTask('updateOwnUser','update own user entry',$bizRule);
		$task->addChild('updateUser');
		 
		$role=$auth->createRole('wishlistAccess');
		$role->addChild('indexWish');
		$role->addChild('viewWish');
		$role->addChild('claimWish');
		$role->addChild('updateOwnUser');
		 
		$role=$auth->createRole('viewer');
		$role->addChild('wishlistAccess');
		$role->addChild('indexBook');
		$role->addChild('viewBook');
		 
		$role=$auth->createRole('borrower');
		$role->addChild('viewer');
		$role->addChild('indexLibrary');
		$role->addChild('requestLibrary');
		 
		$role=$auth->createRole('admin');
		$role->addChild('borrower');
		$role->addChild('lendLibrary');

		$task=$auth->createTask('manageWish','manage wish entries');
		$task->addChild('createWish');
		$task->addChild('updateWish');
		$task->addChild('deleteWish');
		$task->addChild('adminWish');
		$task->addChild('createAuthorWish');
		$task->addChild('removeAuthorWish');
		$role->addChild('manageWish');

		$task=$auth->createTask('manageUser','manage user entries');
		$task->addChild('indexUser');
		$task->addChild('createUser');
		$task->addChild('viewUser');
		$task->addChild('updateUser');
		$task->addChild('deleteUser');
		$task->addChild('aclistUser');
		$role->addChild('manageUser');

		$task=$auth->createTask('manageBook','manage book entries');
		$task->addChild('adminBook');
		$task->addChild('createBook');
		$task->addChild('updateBook');
		$task->addChild('deleteBook');
		$task->addChild('createAuthorBook');
		$task->addChild('removeAuthorBook');
		$role->addChild('manageBook');

		$task=$auth->createTask('managePublisher','manage publisher entries');
		$task->addChild('adminPublisher');
		$task->addChild('indexPublisher');
		$task->addChild('viewPublisher');
		$task->addChild('createPublisher');
		$task->addChild('updatePublisher');
		$task->addChild('deletePublisher');
		$role->addChild('managePublisher');
		 
		$auth->assign('wishlistAccess',54);
		$auth->assign('viewer',53);
		$auth->assign('borrower',52);
		$auth->assign('admin',1);

		echo "Rbac initialized.\n";
	}
}

?>
