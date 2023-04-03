<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\common\helpers\Url;
use shopack\base\frontend\widgets\tabs\Tabs;
use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\common\enums\enuInsurerStatus;
use iranhmusic\shopack\mha\frontend\common\models\MasterInsurerModel;

$this->title = Yii::t('mha', 'Master Insurer') . ': ' . $model->minsID . ' - ' . $model->minsName;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Master Insurers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="master-insurer-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= MasterInsurerModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->minsID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->minsID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->minsID]) : '' ?>
			</div>
      <div class='card-title'><?= Html::encode($this->title) ?></div>
			<div class="clearfix"></div>
		</div>

    <div class='card-tabs'>
      <?php $tabs = Tabs::begin($this); ?>

      <?php $tabs->beginTabPage('مشخصات'); ?>
        <div class='row'>
          <div class='col-8'>
            <?php
              echo DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'attributes' => [
                  'minsID',
                  [
                    'attribute' => 'minsStatus',
                    'value' => enuInsurerStatus::getLabel($model->minsStatus),
                  ],
                  'minsName',
                ],
              ]);
            ?>
          </div>
          <div class='col-4'>
            <?php
              echo DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'attributes' => [
                  'minsCreatedAt:jalaliWithTime',
                  [
                    'attribute' => 'minsCreatedBy_User',
                    'value' => $model->createdByUser->actorName() ?? '-',
                  ],
                  'minsUpdatedAt:jalaliWithTime',
                  [
                    'attribute' => 'minsUpdatedBy_User',
                    'value' => $model->updatedByUser->actorName() ?? '-',
                  ],
                  'minsRemovedAt:jalaliWithTime',
                  [
                    'attribute' => 'minsRemovedBy_User',
                    'value' => $model->removedByUser->actorName() ?? '-',
                  ],
                ],
              ]);
            ?>
          </div>
        </div>

      <?php $tabs->endTabPage(); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Master Insurer Types'), [
          '/mha/master-insurer-type/index',
          'minstypMasterInsurerID' => $model->minsID,
        ],
        'master-insurer-type'
      ); ?>

      <?php $tabs->end(); ?>
    </div>
  </div>
</div>
