<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use kartik\grid\GridView;
use shopack\base\frontend\helpers\Html;
use shopack\base\common\helpers\StringHelper;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use iranhmusic\shopack\mha\common\enums\enuKanoonMembershipDegree;
use iranhmusic\shopack\mha\common\enums\enuMemberKanoonStatus;
?>

<?php
	// echo Alert::widget(['key' => 'shoppingcart']);

	// if (isset($statusReport))
	// 	echo (is_array($statusReport) ? Html::icon($statusReport[0], ['plugin' => 'glyph']) . ' ' . $statusReport[1] : $statusReport);

  echo GridView::widget([
    'id' => StringHelper::generateRandomId(),
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

    'columns' => [
      [
        'class' => 'kartik\grid\SerialColumn',
      ],
      // [
      //   'attribute' => 'usrSearchKey',
      //   'label' => Yii::t('aaa', 'User'),
      //   'format' => 'raw',
      //   'value' => function ($model, $key, $index, $widget) {
      //     return Html::a(str_replace('\n', '<br>', $model->user->displayName()), ['/aaa/user/view', 'id' => $model->mbrknnMemberID]);
      //   },
      // ],
      // [
      //   'class' => \iranhmusic\shopack\mha\frontend\common\widgets\grid\MemberDataColumn::class,
      //   'attribute' => 'mbrknnMemberID',
      //   'format' => 'raw',
      //   'value' => function ($model, $key, $index, $widget) {
      //     return Html::a($model->member->displayName(), ['/mha/member/view', 'id' => $model->mbrknnMemberID], ['class' => ['btn', 'btn-sm', 'btn-outline-secondary']]);
      //   },
      // ],
      [
        'class' => \iranhmusic\shopack\mha\frontend\common\widgets\grid\KanoonDataColumn::class,
        'attribute' => 'mbrknnKanoonID',
        'value' => function ($model, $key, $index, $widget) {
          return $model->kanoon->knnName;
        },
      ],
      [
        'class' => \shopack\base\frontend\widgets\grid\EnumDataColumn::class,
        'enumClass' => enuMemberKanoonStatus::class,
        'attribute' => 'mbrknnStatus',
      ],
      [
        'attribute' => 'mbrknnMembershipDegree',
        'value' => function ($model, $key, $index, $widget) {
          return enuKanoonMembershipDegree::getLabel($model->mbrknnMembershipDegree);
        },
        'filter' => Html::activeDropDownList(
          $searchModel,
          'mbrknnMembershipDegree',
          enuKanoonMembershipDegree::getList(),
          [
            'class' => 'form-control',
            'prompt' => '-- همه --',
            'encode' => false,
            // 'options' => $catOptions,
          ]
        ),
      ],
      [
        'attribute' => 'rowDate',
        'noWrap' => true,
        'format' => 'raw',
        'label' => 'ایجاد / ویرایش',
        'value' => function($model) {
          return Html::formatRowDates(
            $model->mbrknnCreatedAt,
            null, // $model->createdByUser,
            $model->mbrknnUpdatedAt,
            // $model->updatedByUser,
            // $model->mbrknnRemovedAt,
            // $model->removedByUser,
          );
        },
      ],

      [
        'class' => \shopack\base\frontend\widgets\ActionColumn::class,
        'header' => MemberModel::canCreate() ? Html::createButton() : Yii::t('app', 'Actions'),
        'template' => '',
      ]
    ],
    'export' => false,
  ]);
?>
