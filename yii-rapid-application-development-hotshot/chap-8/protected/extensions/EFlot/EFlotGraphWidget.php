<?php
/**
 * EFlotGraphWidget class file.
 *
 * @author Michiel Betel <mbetel@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2010 mbetel
 * @license Public Domain
 * 
 * This code is a rippoff of the Yii JUI code 
 * kudo's to Sebastian Thierer <sebathi@gmail.com>
 * and Qiang Xue <qiang.xue@gmail.com>
 */

Yii::import('application.extensions.EFlot.EFlotWidget');

/**
 * CEFlotGraphWidget displays a flot graph.
 *
 * CEFlotGraphWidget encapsulates the {@link http://code.google.com/p/flot/ flot 
 * graphing plugin.
 *
 * To use this widget, you may insert the following code in a view:
 * <pre>
 * $this->widget('application.extensions.EFlotGraphWidget', array(
 *     'data'=> array(),
 *     'options'=> array(),
 *     'htmlOptions'=>array(
 *         'style'=>'width:300px;height:300px;'
 *     ),
 * ));
 * </pre>
 *
 */
class EFlotGraphWidget extends EFlotWidget
{
	/**
	 * @var string the name of the container element that contains the progress bar. Defaults to 'div'.
	 */
	public $tagName = 'div';

	/**
	 * Run this widget.
	 * This method registers necessary javascript and renders the needed HTML code.
	 */
	public function run()
	{
		$id=$this->getId();
		$this->htmlOptions['id']=$id;        

		echo CHtml::openTag($this->tagName,$this->htmlOptions);
		echo CHtml::closeTag($this->tagName);

		$flotdata=CJavaScript::encode($this->data);
		$flotoptions=CJavaScript::encode($this->options);
		$placeholder = "$('#${id}')";
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"$.plot($placeholder, $flotdata, $flotoptions);");
	}

}