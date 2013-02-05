<?php
echo "<li id=\"role-" . $assignment->itemname. "\">" .
	$assignment->itemname .
	" <input class=\"revoke\" type=\"button\" " . 
		"onClick=\"revoke('" .
			Yii::app()->controller->createUrl("/user/revokeRole",
                        	array("id" => $user->id,
                                	"role_name"=>$assignment->itemname,
                                        "ajax"=>1)) . "', '" . 
			$assignment->itemname . "', '" . 
			Yii::app()->controller->createUrl("/user/reloadRoles",
                        	array("id" => $user->id)) . 
			"')\" " . 
		"value=\"Revoke\" " .
	"/>" .
     "</li>";

