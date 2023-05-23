<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\grid\GridView;
use shopack\base\common\helpers\Url;
use shopack\base\frontend\helpers\Html;
use shopack\base\common\helpers\StringHelper;
use iranhmusic\shopack\mha\common\enums\enuMemberStatus;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
?>

<?php
  $mbrminshstMemberID = Yii::$app->request->queryParams['mbrminshstMemberID'] ?? null;
?>

<?php
	// echo Alert::widget(['key' => 'shoppingcart']);

	// if (isset($statusReport))
	// 	echo (is_array($statusReport) ? Html::icon($statusReport[0], ['plugin' => 'glyph']) . ' ' . $statusReport[1] : $statusReport);

  $columns = [
    [
      'class' => 'kartik\grid\SerialColumn',
    ],
    // [
    //   'attribute' => 'usrSearchKey',
    //   'label' => Yii::t('aaa', 'User'),
    //   'format' => 'raw',
    //   'value' => function ($model, $key, $index, $widget) {
    //     return Html::a(str_replace('\n', '<br>', $model->user->displayName()), ['/aaa/user/view', 'id' => $model->mbrminshstMemberID]);
    //   },
    // ],
  ];

  if (empty($mbrminshstMemberID)) {
    $columns = array_merge($columns, [
      [
        'class' => \iranhmusic\shopack\mha\frontend\common\widgets\grid\MemberDataColumn::class,
        'attribute' => 'mbrminshstMemberID',
        'format' => 'raw',
        'value' => function ($model, $key, $index, $widget) {
          return Html::a($model->member->displayName(), ['/mha/member/view', 'id' => $model->mbrminshstMemberID], ['class' => ['btn', 'btn-sm', 'btn-outline-secondary']]);
        },
      ],
    ]);
  }

  $columns = array_merge($columns, [
    [
      'attribute' => 'mbrminshstMasterInsTypeID',
      'value' => function ($model, $key, $index, $widget) {
        return $model->masterInsuranceType->masterInsurer->minsName . ' - ' . $model->masterInsuranceType->minstypName;
      },
    ],
    'mbrminshstSubstation',
    'mbrminshstStartDate:jalali',
    'mbrminshstEndDate:jalali',
    'mbrminshstInsuranceCode',
    'mbrminshstCoCode',
    'mbrminshstCoName',
    'mbrminshstIssuanceDate:jalali',

    [
      'attribute' => 'rowDate',
      'noWrap' => true,
      'format' => 'raw',
      'label' => 'ایجاد / ویرایش',
      'value' => function($model) {
        return Html::formatRowDates(
          $model->mbrminshstCreatedAt,
          $model->createdByUser,
          $model->mbrminshstUpdatedAt,
          $model->updatedByUser,
          // $model->mbrminshstRemovedAt,
          // $model->removedByUser,
        );
      },
    ],

    [
      'class' => \shopack\base\frontend\widgets\ActionColumn::class,
      'header' => MemberModel::canCreate() ? Html::createButton(null, [
        'create',
        'mbrminshstMemberID' => $_GET['mbrminshstMemberID'] ?? null,
      ]) : Yii::t('app', 'Actions'),
      'template' => '{update} {delete}{undelete}',
      'visibleButtons' => [
        'update' => function ($model, $key, $index) {
          return $model->canUpdate();
        },
        'delete' => function ($model, $key, $index) {
          return $model->canDelete();
        },
        'undelete' => function ($model, $key, $index) {
          return $model->canUndelete();
        },
      ],
    ]
  ]);

  echo GridView::widget([
    'id' => StringHelper::generateRandomId(),
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $columns,
  ]);
?>
