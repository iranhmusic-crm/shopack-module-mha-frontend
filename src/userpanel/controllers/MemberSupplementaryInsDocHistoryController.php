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
use iranhmusic\shopack\mha\frontend\common\models\MemberSupplementaryInsDocHistoryModel;
use iranhmusic\shopack\mha\frontend\common\models\MemberSupplementaryInsDocHistorySearchModel;
use iranhmusic\shopack\mha\common\enums\enuInsurerDocStatus;
use yii\web\NotFoundHttpException;

class MemberSupplementaryInsDocHistoryController extends BaseController
{
	// public $modelClass = MemberSupplementaryInsDocHistoryModel::class;
	// public $searchModelClass = MemberSupplementaryInsDocHistorySearchModel::class;
	// public $modalDoneFragment = 'member-supplementary-ins-docs';

	// public function init()
	// {
	// 	$this->doneLink = function ($model) {
	// 		return Url::to(['index']);
	// 	};

	// 	parent::init();
	// }

  // public function actionCreate_afterCreateModel(&$model)
  // {
	// 	$model->mbrsinsdochstSupplementaryInsDocID = $_GET['mbrsinsdochstSupplementaryInsDocID'] ?? null;
	// 	$model->mbrsinsdochstAction = enuInsurerDocStatus::WaitForSurvey;
  // }

	// public function getSearchParams()
  // {
  //   return array_replace_recursive(Yii::$app->request->queryParams, [
	// 		'XXXXXXXXXX' => Yii::$app->user->id,
	// 	]);
  // }

	public function actionDetailList()
	{
		if (empty($_POST['expandRowKey']))
			throw new NotFoundHttpException('The requested item not exist.');

		$key = $_POST['expandRowKey'];

		$searchModel = new MemberSupplementaryInsDocHistorySearchModel();
		$dataProvider = $searchModel->search([
			$searchModel->formName() => [
				'mbrsinsdochstSupplementaryInsDocID' => $key,
			],
		]);

		return $this->renderJson($this->renderAjax('_detail_list', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
 			'expandRowKey' => $key,
		]));

	}

}
