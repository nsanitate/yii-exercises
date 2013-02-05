<?php
/**
 * assignments.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */
/**
 * The view of the users assignments
 * If no user id is passed a drop down with all users is shown
 * Else the user's assignments are shown.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.0.1
 */
?>
<?php
$this->breadcrumbs = array(
    'Srbac Assignments'
  )
?>
<?php if ($this->module->getMessage() != "") { ?>
  <div id="srbacError">
    <?php echo $this->module->getMessage(); ?>
  </div>
<?php } ?>
<?php
if (!$id) {
  if ($this->module->getShowHeader()) {
    $this->renderPartial($this->module->header);
  }
  ?>
  <div class="simple">
    <?php
    $this->renderPartial("frontpage");
    ?>
    <?php echo SHtml::beginForm(); ?>
    <?php
    echo Helper::translate('srbac', 'User') . ": " . SHtml::activeDropDownList($this->module->getUserModel(), $this->module->userid, SHtml::listData($this->module->getUserModel()->findAll(), $this->module->userid, $this->module->username), array('disabled'=>'disabled', 'size' => 1, 'class' => 'dropdown', 'ajax' => array(
            'type' => 'POST',
            'url' => array('showAssignments'),
            'update' => '#assignments',
            'beforeSend' => 'function(){
                      $("#assignments").addClass("srbacLoading");
                  }',
            'complete' => 'function(){
                      $("#assignments").removeClass("srbacLoading");
                  }'
        ),
        'prompt' => Helper::translate('srbac', 'select user')
    ));
    ?>
    <?php
    $parent = $this->module->parentModule ? $this->module->parentModule->name."/" : "" ;
    $data = $this->module->getUserModel()->findAll();
     $url = Yii::app()->urlManager->createUrl("srbac/authitem/showAssignments"); 
 
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' =>$this->module->getUserModel(),
        'attribute'=>$this->module->username,
        'sourceUrl' => Yii::app()->urlManager->createUrl($parent."srbac/authitem/getUsers") ,
        // additional javascript options for the autocomplete plugin
        'options' => array(
            'minLength' => '2',
            'select'=>'js:function(event,ui){
              $.ajax({
                url: "'.$url.'",
                  data : "id="+ui.item.id,
                success: function(html){
                  $("#assignments").html(html);
                }
              });
        }',
        ),
        'htmlOptions' => array(
            'style' => 'height:20px;'
        ),
    ));
    ?>
  <?php echo SHtml::endForm(); ?>
  </div>
<?php } else { ?>
  <?php $url = Yii::app()->urlManager->createUrl("srbac/authitem/showAssignments", array("id" => $id)); ?>
  <?php Yii::import("srbac.components.Helper"); ?>
  <?php Helper::publishCss(Yii::app()->getModule('srbac')->css, true); ?>
  <?php
  Yii::app()->clientScript->registerScript(
    "alert", "$.ajax({
            type: 'POST',
            url: '" . $url . "',
            success: function(html){
               $('#assignments').html(html);
        }
          });
      ", CClientScript::POS_READY
  );
  ?>
<?php } ?>
<div id="assignments">

</div>
<?php if (!$id) { ?>
  <?php
  if ($this->module->getShowFooter()) {
    $this->renderPartial($this->module->footer);
  }
  ?>
<?php
}?>