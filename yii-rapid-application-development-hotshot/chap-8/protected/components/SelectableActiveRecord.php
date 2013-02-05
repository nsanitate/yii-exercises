<?php 

class SelectableActiveRecord extends CActiveRecord {

        public function getOptions()
        {
                return CHtml::listData($this->findAll(),'id','name');
        }

}

