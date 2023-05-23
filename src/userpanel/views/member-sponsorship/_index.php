<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\grid\GridView;
use shopack\base\frontend\helpers\Html;
use shopack\base\common\helpers\StringHelper;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use shopack\aaa\common\enums\enuGender;
use iranhmusic\shopack\mha\common\enums\enuSponsorshipType;
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
      //     return Html::a(str_replace('\n', '<br>', $model->user->displayName()), ['/aaa/user/view', 'id' => $model->mbrspsMemberID]);
      //   },
      // ],
      // [
      //   // 'class' => \iranhmusic\shopack\mha\frontend\common\widgets\grid\MemberDataColumn::class,
      //   'attribute' => 'mbrspsMemberID',
      //   'format' => 'raw',
      //   'value' => function ($model, $key, $index, $widget) {
      //     return Html::a($model->member->displayName(), ['/mha/member/view', 'id' => $model->mbrspsMemberID], ['class' => ['btn', 'btn-sm', 'btn-outline-secondary']]);
      //   },
      // ],
      'mbrspsFirstName',
      'mbrspsLastName',
      [
        'class' => \shopack\base\frontend\widgets\grid\EnumDataColumn::class,
        'enumClass' => enuSponsorshipType::class,
        'attribute' => 'mbrspsType',
      ],
      [
        'class' => \shopack\base\frontend\widgets\grid\EnumDataColumn::class,
        'enumClass' => enuGender::class,
        'attribute' => 'mbrspsGender',
      ],
      'mbrspsShID',
      'mbrspsSSN',
      // 'mbrspsFatherName',
      'mbrspsBirthDate:jalali',
      'mbrspsBirthLocation',

      // [
      //   'attribute' => 'mbrspsMasterInsTypeID',
      //   'value' => function ($model, $key, $index, $widget) {
      //     return $model->masterInsuranceType->masterInsurer->minsName . ' - ' . $model->masterInsuranceType->minstypName;
      //   },
      // ],
      // 'mbrspsSubstation',
      // 'mbrspsInsuranceCode',

      [
        'attribute' => 'rowDate',
        'noWrap' => true,
        'format' => 'raw',
        'label' => 'ایجاد / ویرایش',
        'value' => function($model) {
          return Html::formatRowDates(
            $model->mbrspsCreatedAt,
            null,
            // $model->createdByUser,
            $model->mbrspsUpdatedAt,
            // $model->updatedByUser,
            // $model->mbrspsRemovedAt,
            // $model->removedByUser,
          );
        },
      ],

      [
        'class' => \shopack\base\frontend\widgets\ActionColumn::class,
        'header' => MemberModel::canCreate() ? Html::createButton() : Yii::t('app', 'Actions'),
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
    ],
  ]);
?>
