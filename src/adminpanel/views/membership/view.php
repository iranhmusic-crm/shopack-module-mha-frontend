<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use iranhmusic\shopack\mha\common\enums\enuMembershipStatus;
use iranhmusic\shopack\mha\frontend\common\models\MembershipModel;

$this->title = Yii::t('mha', 'Membership') . ': ' . $model->mshpID . ' - ' . $model->mshpTitle;
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Memberships'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="membership-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= MembershipModel::canCreate() ? Html::createButton() : '' ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->mshpID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->mshpID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->mshpID]) : '' ?>
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
                'mshpID',
                [
                  'attribute' => 'mshpStatus',
                  'value' => enuMembershipStatus::getLabel($model->mshpStatus),
                ],
                'mshpTitle',
                'mshpStartFrom:jalali',
                [
                  'attribute' => 'mshpYearlyPrice',
                  'value' => Yii::$app->formatter->asDecimal($model->mshpYearlyPrice, null, [], [], '-') . ' تومان',
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
                'mshpCreatedAt:jalaliWithTime',
                [
                  'attribute' => 'mshpCreatedBy_User',
                  'value' => $model->createdByUser->actorName() ?? '-',
                ],
                'mshpUpdatedAt:jalaliWithTime',
                [
                  'attribute' => 'mshpUpdatedBy_User',
                  'value' => $model->updatedByUser->actorName() ?? '-',
                ],
                'mshpRemovedAt:jalaliWithTime',
                [
                  'attribute' => 'mshpRemovedBy_User',
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
