<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use kartik\grid\GridView;
use shopack\base\frontend\helpers\Html;
use shopack\base\common\helpers\StringHelper;
use iranhmusic\shopack\mha\common\enums\enuKanoonStatus;
use iranhmusic\shopack\mha\frontend\common\models\KanoonModel;

$this->title = Yii::t('mha', 'Kanoons');
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kanoon-index w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
        <?= KanoonModel::canCreate() ? Html::createButton() : '' ?>
			</div>
      <div class='card-title'><?= Html::encode($this->title) ?></div>
			<div class="clearfix"></div>
		</div>

    <div class='card-body'>
      <?php
      echo GridView::widget([
        'id' => StringHelper::generateRandomId(),
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
          [
            'class' => 'kartik\grid\SerialColumn',
          ],
          'knnID',
          [
            'attribute' => 'knnName',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $widget) {
              return Html::a($model->knnName, ['view', 'id' => $model->knnID]);
            },
          ],
          // [
          //   'attribute' => 'knnPresidentMemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnPresidentMemberID))
          //       return $model->president->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnVicePresidentMemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnVicePresidentMemberID))
          //       return $model->vicePresident->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnOzv1MemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnOzv1MemberID))
          //       return $model->ozv1->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnOzv2MemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnOzv2MemberID))
          //       return $model->ozv2->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnOzv3MemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnOzv3MemberID))
          //       return $model->ozv3->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnWardenMemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnWardenMemberID))
          //       return $model->warden->displayName();
          //     return null;
          //   },
          // ],
          // [
          //   'attribute' => 'knnTalkerMemberID',
          //   'value' => function ($model, $key, $index, $widget) {
          //     if (isset($model->knnTalkerMemberID))
          //       return $model->talker->displayName();
          //     return null;
          //   },
          // ],
          [
            'class' => \shopack\base\frontend\widgets\grid\EnumDataColumn::class,
            'enumClass' => enuKanoonStatus::class,
            'attribute' => 'knnStatus',
          ],
          [
            'attribute' => 'rowDate',
            'noWrap' => true,
            'format' => 'raw',
            'label' => 'ایجاد / ویرایش',
            'value' => function($model) {
              return Html::formatRowDates(
                $model->knnCreatedAt,
                $model->createdByUser,
                $model->knnUpdatedAt,
                $model->updatedByUser,
                $model->knnRemovedAt,
                $model->removedByUser,
              );
            },
          ],
          [
            'class' => \shopack\base\frontend\widgets\ActionColumn::class,
            'header' => KanoonModel::canCreate() ? Html::createButton() : Yii::t('app', 'Actions'),
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
        'export' => false,
      ]);
      ?>
    </div>
  </div>
</div>
