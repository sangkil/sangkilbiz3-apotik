<?php

namespace biz\inventory;


class Module extends \yii\base\Module
{
	public $controllerNamespace = 'biz\inventory\controllers';

	public function init()
	{
		parent::init();
        if(!isset($this->controllerMap['default'])){
            $this->controllerMap['default'] = 'biz\master\components\DefaultController';
        }

		// custom initialization code goes here
	}
}
