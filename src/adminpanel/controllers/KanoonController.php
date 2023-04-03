<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\adminpanel\controllers;

use shopack\aaa\frontend\common\auth\BaseCrudController;
use iranhmusic\shopack\mha\frontend\common\models\KanoonModel;
use iranhmusic\shopack\mha\frontend\common\models\KanoonSearchModel;
use iranhmusic\shopack\mha\common\enums\enuKanoonStatus;

class KanoonController extends BaseCrudController
{
	public $modelClass = KanoonModel::class;
	public $searchModelClass = KanoonSearchModel::class;

}
