<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\frontend\common\models\DocumentModel;
use iranhmusic\shopack\mha\common\enums\enuDocumentType;
use iranhmusic\shopack\mha\common\enums\enuDocumentStatus;

$this->title = Yii::t('mha', 'Document') . ': ' . $model->docID . ' - ' . $model->docName;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="document-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= DocumentModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->docID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->docID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->docID]) : '' ?>
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
                'docID',
                [
                  'attribute' => 'docStatus',
                  'value' => enuDocumentStatus::getLabel($model->docStatus),
                ],
                'docName',
                [
                  'attribute' => 'docType',
                  'value' => enuDocumentType::getLabel($model->docType),
                ],
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
                'docCreatedAt:jalaliWithTime',
                [
                  'attribute' => 'docCreatedBy_User',
                  'value' => $model->createdByUser->actorName() ?? '-',
                ],
                'docUpdatedAt:jalaliWithTime',
                [
                  'attribute' => 'docUpdatedBy_User',
                  'value' => $model->updatedByUser->actorName() ?? '-',
                ],
                'docRemovedAt:jalaliWithTime',
                [
                  'attribute' => 'docRemovedBy_User',
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
