<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\common\enums\enuKanoonStatus;
use iranhmusic\shopack\mha\frontend\common\models\KanoonModel;

$this->title = Yii::t('mha', 'Kanoon') . ': ' . $model->knnID . ' - ' . $model->knnName;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Kanoons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kanoon-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= KanoonModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->knnID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->knnID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->knnID]) : '' ?>
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
                'knnID',
                [
                  'attribute' => 'knnStatus',
                  'value' => enuKanoonStatus::getLabel($model->knnStatus),
                ],
                'knnName',
                [
                  'attribute' => 'knnPresidentMemberID',
                  'value' => (isset($model->knnPresidentMemberID)
                    ? $model->president->displayName() : null),
                ],
                [
                  'attribute' => 'knnVicePresidentMemberID',
                  'value' => (isset($model->knnVicePresidentMemberID)
                    ? $model->vicePresident->displayName() : null),
                ],
                [
                  'attribute' => 'knnOzv1MemberID',
                  'value' => (isset($model->knnOzv1MemberID)
                    ? $model->ozv1->displayName() : null),
                ],
                [
                  'attribute' => 'knnOzv2MemberID',
                  'value' => (isset($model->knnOzv2MemberID)
                    ? $model->ozv2->displayName() : null),
                ],
                [
                  'attribute' => 'knnOzv3MemberID',
                  'value' => (isset($model->knnOzv3MemberID)
                    ? $model->ozv3->displayName() : null),
                ],
                [
                  'attribute' => 'knnWardenMemberID',
                  'value' => (isset($model->knnWardenMemberID)
                    ? $model->warden->displayName() : null),
                ],
                [
                  'attribute' => 'knnTalkerMemberID',
                  'value' => (isset($model->knnTalkerMemberID)
                    ? $model->talker->displayName() : null),
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
                'knnCreatedAt:jalaliWithTime',
                [
                  'attribute' => 'knnCreatedBy_User',
                  'value' => $model->createdByUser->actorName() ?? '-',
                ],
                'knnUpdatedAt:jalaliWithTime',
                [
                  'attribute' => 'knnUpdatedBy_User',
                  'value' => $model->updatedByUser->actorName() ?? '-',
                ],
                'knnRemovedAt:jalaliWithTime',
                [
                  'attribute' => 'knnRemovedBy_User',
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
