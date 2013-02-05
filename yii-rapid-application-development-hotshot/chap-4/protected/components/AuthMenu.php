<?php

Yii::import('zii.widgets.CMenu');

/**
 * Auth Menu extends CMenu to apply access rules to menu items before 
 * displaying them. The idea is to define menu items once and only
 * display relevant items.
 * 
 * This extension was inspired by YiiSmartMenu
 *
 * @author Lauren O'Meara <lauren@plumflowersoftware.com>
 * @copyright Copyright &copy; 2012 Plum Flower Software
 * @version 0.1
 * @license New BSD Licence
 */
class AuthMenu extends CMenu
{
    public function init() {
        $this->items = $this->filterItems($this->items);
        return parent::init();
    }

    /**
     * Filter recursively the menu items received setting visibility true or
     * false according to controller/action preFilter
     *
     * @param array $items The menu items being filtered.
     * @return array The menu items with visibility defined by preFilter().
     */
    protected function filterItems(array $items){
	$app = Yii::app();
        foreach($items as $pos=>$item)
        {
            if(!isset($item['visible']))
            {
		// get the url parameter
            	if(isset($item['url']) && is_array($item['url']))
                	$url=$item['url'][0];

		// parse the url into controller and action
		$parts = explode("/",$url);
		if ( count($parts) == 1) {
			$controller = $app->controller;
			$actionId = $parts[0];
		} else { 
			$controllerId = ucfirst($parts[1]);
			$actionId = count($parts) > 2 ? $parts[2] : 'index';
			$controllerList = $app->createController($controllerId);
			$controller = $controllerList[0];
		}

		if ($controller == null) {
			break;
		}

		// generate a controller instance to access and compare 
		// the rules
		$action = $controller->createAction($actionId);
		$filter = new CAccessControlFilter;
		$filter->setRules($controller->accessRules());
		$user = $app->getUser();
		$request = $app->getRequest();
		$ip = $request->getUserHostAddress();
		$item['visible'] = false;
		foreach ($filter->getRules() as $rule) {
			// we are making an assumption for now that all
			// menu items are GET actions
			if($rule->isUserAllowed($user, $controller, $action, $ip, 'GET') > 0) {
				$item['visible'] = true;
				break;
			}
		}
            }

            /**
             * If current item is visible and has sub items, loops recursively
             * on them.
             */
            if(isset($item['items']) && $item['visible'])
                $item['items']=$this->filterItems($item['items']);

            $items[$pos]=$item;
        }
        return $items;
    }
}
