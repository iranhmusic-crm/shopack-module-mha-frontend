<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\PopoverX;
use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\frontend\common\models\BasicDefinitionModel;
use iranhmusic\shopack\mha\common\enums\enuBasicDefinitionType;
use iranhmusic\shopack\mha\common\enums\enuBasicDefinitionStatus;

$this->title = Yii::t('mha', 'Basic Definition') . ': ' . $model->bdfID . ' - ' . $model->bdfName;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Basic Definitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="basic-definition-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= BasicDefinitionModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->bdfID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->bdfID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->bdfID]) : '' ?>
        <?php
          PopoverX::begin([
            // 'header' => 'Hello world',
            'closeButton' => false,
            'toggleButton' => [
              'label' => Yii::t('aaa', 'Logs'),
              'class' => 'btn btn-default',
            ],
            'placement' => PopoverX::ALIGN_AUTO_BOTTOM,
          ]);

          echo DetailView::widget([
            'model' => $model,
            'enableEditMode' => false,
            'attributes' => [
              'bdfCreatedAt:jalaliWithTime',
              [
                'attribute' => 'bdfCreatedBy_User',
                'format' => 'raw',
                'value' => $model->createdByUser->actorName ?? '-',
              ],
              'bdfUpdatedAt:jalaliWithTime',
              [
                'attribute' => 'bdfUpdatedBy_User',
                'format' => 'raw',
                'value' => $model->updatedByUser->actorName ?? '-',
              ],
              'bdfRemovedAt:jalaliWithTime',
              [
                'attribute' => 'bdfRemovedBy_User',
                'format' => 'raw',
                'value' => $model->removedByUser->actorName ?? '-',
              ],
            ],
          ]);

          PopoverX::end();
        ?>
			</div>
      <div class='card-title'><?= Html::encode($this->title) ?></div>
			<div class="clearfix"></div>
		</div>

    <div class='card-body'>
      <?php
        echo DetailView::widget([
          'model' => $model,
          'enableEditMode' => false,
          'attributes' => [
            'bdfID',
            [
              'attribute' => 'bdfStatus',
              'value' => enuBasicDefinitionStatus::getLabel($model->bdfStatus),
            ],
            'bdfName',
            [
              'attribute' => 'bdfType',
              'value' => enuBasicDefinitionType::getLabel($model->bdfType),
            ],
          ],
        ]);
      ?>
    </div>
  </div>
</div>
