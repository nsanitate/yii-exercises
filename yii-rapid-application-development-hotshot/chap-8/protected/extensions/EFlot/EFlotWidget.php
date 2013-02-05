<?php
/**
 * EFlotWidget class file.
 * @author Michiel Betel <mbetel@gmail.com>
 *
 * This is the base class for all EFlotGraph widget classes.
 * Modified zii JUI base class by Michiel Betel <mbetel@gmail.com>
 * 
 * Original by: 
 * @author Sebastian Thierer <sebathi@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 */
abstract class EFlotWidget extends CWidget
{
	public $scriptUrl;

	public $themeUrl;

	public $theme='base';

	public $scriptFile=array('excanvas.min.js','jquery.flot.js','jquery.flot.pie.js');

	public $cssFile=false;

	public $data=array();
	public $options=array();

	public $htmlOptions=array();

	public function init()
	{
		$this->resolvePackagePath();
		$this->registerCoreScripts();
		parent::init();
	}

	protected function resolvePackagePath()
	{
		if($this->scriptUrl===null || $this->themeUrl===null)
		{
			$basePath=Yii::getPathOfAlias('application.extensions.EFlot.assets');
			$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
			if($this->scriptUrl===null)
				$this->scriptUrl=$baseUrl.'';
			if($this->themeUrl===null)
				$this->themeUrl=$baseUrl.'/css';
		}
	}

	protected function registerCoreScripts()
	{
		$cs=Yii::app()->getClientScript();
		if(is_string($this->cssFile))
			$cs->registerCssFile($this->themeUrl.'/'.$this->theme.'/'.$this->cssFile);
		else if(is_array($this->cssFile))
		{
			foreach($this->cssFile as $cssFile)
				$cs->registerCssFile($this->themeUrl.'/'.$this->theme.'/'.$cssFile);
		}

		$cs->registerCoreScript('jquery');
		if(is_string($this->scriptFile))
			$this->registerScriptFile($this->scriptFile);
		else if(is_array($this->scriptFile))
		{
			foreach($this->scriptFile as $scriptFile)
				$this->registerScriptFile($scriptFile);
		}
	}

	protected function registerScriptFile($fileName,$position=CClientScript::POS_HEAD)
	{
		Yii::app()->getClientScript()->registerScriptFile($this->scriptUrl.'/'.$fileName,$position);
	}
}
