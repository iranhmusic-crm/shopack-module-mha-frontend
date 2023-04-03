<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\common\helpers\Url;
use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\common\enums\enuInsurerStatus;
use iranhmusic\shopack\mha\frontend\common\models\SupplementaryInsurerModel;

$this->title = Yii::t('mha', 'Supplementary Insurer') . ': ' . $model->sinsID . ' - ' . $model->sinsName;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Supplementary Insurers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="supplementary-insurer-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= SupplementaryInsurerModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->sinsID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->sinsID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->sinsID]) : '' ?>
			</div>
      <div class='card-title'><?= Html::encode($this->title) ?></div>
			<div class="clearfix"></div>
		</div>

    <div class='card-body'>
      <div class='row'>
        <div class='col-8'>
          <?php
            echo DetailView::widget([
              'model' => $model,
              'enableEditMode' => false,
              'attributes' => [
                'sinsID',
                [
                  'attribute' => 'sinsStatus',
                  'value' => enuInsurerStatus::getLabel($model->sinsStatus),
                ],
                'sinsName',
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
                'sinsCreatedAt:jalaliWithTime',
                [
                  'attribute' => 'sinsCreatedBy_User',
                  'value' => $model->createdByUser->actorName() ?? '-',
                ],
                'sinsUpdatedAt:jalaliWithTime',
                [
                  'attribute' => 'sinsUpdatedBy_User',
                  'value' => $model->updatedByUser->actorName() ?? '-',
                ],
                'sinsRemovedAt:jalaliWithTime',
                [
                  'attribute' => 'sinsRemovedBy_User',
                  'value' => $model->removedByUser->actorName() ?? '-',
                ],
              ],
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
