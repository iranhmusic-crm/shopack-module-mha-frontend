<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\helpers\Html;
use shopack\base\frontend\widgets\DetailView;
use shopack\aaa\common\enums\enuGender;
use shopack\aaa\common\enums\enuUserStatus;
use iranhmusic\shopack\mha\common\enums\enuMemberStatus;

$this->title = Yii::t('mha', 'My Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-view w-100">
	<div class='card border-0'>

		<div class='card-body'>
			<div class='row'>
				<div class='col-sm-9'>
					<?php
						echo DetailView::widget([
							'model' => $model,
							'enableEditMode' => false,
							'cols' => 2,
							'isVertical' => false,
							'attributes' => [
								[
									'attribute' => 'mbrUserID',
									'label' => 'کد کاربری',
								],
								[
									'attribute' => 'usrStatus',
									'value' => enuUserStatus::getLabel($model->user->usrStatus),
								],
								'mbrRegisterCode',
								[
									'attribute' => 'mbrStatus',
									'value' => enuMemberStatus::getLabel($model->mbrStatus),
								],
								'mbrAcceptedAt:jalaliWithTime',
								[
									'group' => true,
									// 'cols' => 1,
									'label' => 'اطلاعات پایه',
								],
								[
									'attribute' => 'usrEmail',
									'valueColOptions' => ['class' => ['dir-ltr', 'text-start']],
									'value' => $model->user->usrEmail,
								],
								[
									'attribute' => 'usrEmailApprovedAt',
									'format' => 'jalaliWithTime',
									'value' => $model->user->usrEmailApprovedAt,
								],
								[
									'attribute' => 'usrMobile',
									'valueColOptions' => ['class' => ['dir-ltr', 'text-start']],
									'value' => $model->user->usrMobile,
								],
								[
									'attribute' => 'usrMobileApprovedAt',
									'format' => 'jalaliWithTime',
									'value' => $model->user->usrMobileApprovedAt,
								],
								[
									'attribute' => 'usrSSID',
									'value' => $model->user->usrSSID,
								],
								[
									'attribute' => 'usrGender',
									'value' => enuGender::getLabel($model->usrGender),
								],
								[
									'attribute' => 'usrFirstName',
									'value' => $model->user->usrFirstName,
								],
								[
									'attribute' => 'usrFirstName_en',
									'value' => $model->user->usrFirstName_en,
								],
								[
									'attribute' => 'usrLastName',
									'value' => $model->user->usrLastName,
								],
								[
									'attribute' => 'usrLastName_en',
									'value' => $model->user->usrLastName_en,
								],
								[
									'group' => true,
									'label' => 'اطلاعات تکمیلی',
								],
								'mbrMusicExperiences',
								'mbrMusicExperienceStartAt',
								[
									'group' => true,
									'cols' => 1,
								],
								'mbrArtHistory',
								'mbrMusicEducationHistory',
							],
						]);
					?>
				</div>

				<div class='col-sm-3'>
					<div class='card border-default'>
						<div class='card-header bg-default'>
							<div class="float-end">
							</div>
							<div class='card-title'><?= Yii::t('app', 'Actions') ?></div>
							<div class="clearfix"></div>
						</div>
						<div class='card-body text-center'>
							<?= $model->canUpdate() ? Html::updateButton(null, ['update'], [
								'data' => [
									'popup-size' => 'lg',
								],
							]) : '' ?>
						</div>
					</div>

					<p>&nbsp;</p>

					<div class='card border-default'>
						<div class='card-header bg-default'>
							<div class="float-end">
								<?= Html::updateButton(Yii::t('aaa', 'Update Image'), ['/aaa/profile/update-image'], [
									// 'modal' => false,
								]) ?>
							</div>
							<div class='card-title'><?= Yii::t('aaa', 'Image') ?></div>
							<div class="clearfix"></div>
						</div>
						<div class='card-body text-center'>
							<?php
								if ($model->user->usrImageFileID == null)
									echo Yii::t('app', 'not set');
								elseif (empty($model->user->imageFile->fullFileUrl))
									echo Yii::t('aaa', 'Uploading...');
								elseif ($model->user->imageFile->isImage())
									echo Html::img($model->user->imageFile->fullFileUrl, ['style' => ['width' => '100%']]);
								else
									echo Html::a(Yii::t('app', 'Download'), $model->imageFile->fullFileUrl);
							?>
						</div>
					</div>
				</div>
			</div>
    </div>
	</div>
</div>
