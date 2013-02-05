<div id="role_list">
		<b>Un Assigned Roles</b><br/>
                <?php echo SHtml::activeDropDownList($user,'role',
                SHtml::listData(
                        $user->getUnassignedRoles(), 'name', 'name'),
                        array('size'=>5, 'class'=>'dropdown')); ?>
                <br/>
                <input class="assign" type="button" 
			onClick="assign('<?php
                                echo Yii::app()->controller->createUrl(
                                        "/user/assignRole",
                                        array("id"=>$user->id)); ?>','<?php
                                echo Yii::app()->controller->createUrl(
                                        "/user/reloadRoles",
                                        array("id"=>$user->id)); ?>')"
                        value="Add"/>
</div>
