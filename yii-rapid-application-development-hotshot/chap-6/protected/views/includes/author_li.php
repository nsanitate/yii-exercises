<?php
                                echo "<li id=\"author-" . $author->id. "\">" .
                                        $author->fname . " " .
                                        $author->lname .
                                        " <input class=\"delete\" " .
                                                "type=\"button\" url=\"" .
                                Yii::app()->controller->createUrl("removeAuthor",
                                                array("id" => $model->id,
                                                "author_id"=>$author->id,
                                                "ajax"=>1)) .
                                        "\" author_id=\"". $author->id.
                                        "\" value=\"delete\" />" .
                                        "</li>";

