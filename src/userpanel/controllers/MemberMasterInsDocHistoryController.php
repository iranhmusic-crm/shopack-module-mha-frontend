<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\userpanel\controllers;

use Yii;
use yii\web\Response;
use shopack\base\common\helpers\Url;
use shopack\base\common\helpers\StringHelper;
use shopack\base\common\helpers\HttpHelper;
use shopack\aaa\frontend\common\auth\BaseController;
use iranhmusic\shopack\mha\frontend\common\models\MemberMasterInsDocHistoryModel;
use iranhmusic\shopack\mha\frontend\common\models\MemberMasterInsDocHistorySearchModel;
use iranhmusic\shopack\mha\common\enums\enuInsurerDocStatus;
use yii\web\NotFoundHttpException;

class MemberMasterInsDocHistoryController extends BaseController
{
	// public $modelClass = MemberMasterInsDocHistoryModel::class;
	// public $searchModelClass = MemberMasterInsDocHistorySearchModel::class;
	// public $modalDoneFragment = 'member-master-ins-docs';

	// public function init()
	// {
	// 	$this->doneLink = function ($model) {
	// 		return Url::to(['index']);
	// 	};

	// 	parent::init();
	// }

  // public function actionCreate_afterCreateModel(&$model)
  // {
	// 	$model->mbrminsdochstMasterInsDocID = Yii::$app->user->id;
	// 	$model->mbrminsdochstAction = enuInsurerDocStatus::WaitForSurvey;
  // }

	// public function getSearchParams()
  // {
  //   return array_replace_recursive(Yii::$app->request->queryParams, [
	// 		'mbrminsdochstMasterInsDocID' => Yii::$app->user->id,
	// 	]);
  // }

	public function actionDetailList()
	{
		if (empty($_POST['expandRowKey']))
			throw new NotFoundHttpException('The requested item not exist.');

		$key = $_POST['expandRowKey'];

		$searchModel = new MemberMasterInsDocHistorySearchModel();
		$dataProvider = $searchModel->search([
			$searchModel->formName() => [
				'mbrminsdochstMasterInsDocID' => $key,
			],
		]);

		return $this->renderJson($this->renderAjax('_detail_list', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
 			'expandRowKey' => $key,
		]));

	}

}
