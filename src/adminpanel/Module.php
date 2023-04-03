<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\adminpanel;

use Yii;
use yii\base\BootstrapInterface;

class Module
	extends \shopack\base\common\base\BaseModule
	implements BootstrapInterface
{
	public function init()
	{
		if (empty($this->id))
			$this->id = 'mha';

		parent::init();
	}

	public function bootstrap($app)
	{
		if ($app instanceof \yii\web\Application) {
			// $rules = [
			// ];

			// $app->urlManager->addRules($rules, false);

			$this->addDefaultRules($app);

		} elseif ($app instanceof \yii\console\Application) {
			$this->controllerNamespace = 'iranhmusic\shopack\mha\frontend\adminpanel\commands';
		}
	}

}
