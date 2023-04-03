<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

use yii\web\JsExpression;
use borales\extensions\phoneInput\PhoneInput;
use shopack\base\common\helpers\Url;
use shopack\base\frontend\widgets\Select2;
use shopack\base\frontend\widgets\DepDrop;
use shopack\base\frontend\helpers\Html;
use shopack\base\common\helpers\HttpHelper;
use shopack\base\frontend\widgets\ActiveForm;
use shopack\base\frontend\widgets\FormBuilder;
use shopack\aaa\frontend\common\models\UserModel;
use shopack\aaa\common\enums\enuGender;
use iranhmusic\shopack\mha\common\enums\enuMemberStatus;
?>

<div class='member-form'>
	<?php
		$form = ActiveForm::begin([
			'model' => $model,
		]);

		$builder = $form->getBuilder();

		$builder->fields([
			[
				'mbrUserID',
				'type' => FormBuilder::FIELD_STATIC,
				'staticValue' => $model->user->displayName(),
			],
		]);

		$builder->fields([
			['mbrMusicExperiences'],
			['mbrMusicExperienceStartAt'], //Y/M/D
			['mbrArtHistory'],
			['mbrMusicEducationHistory'],
		]);
	?>

	<?php $builder->beginField(); ?>
		<div id='params-container' class='row offset-md-2'></div>
	<?php $builder->endField(); ?>

	<?php $builder->beginFooter(); ?>
		<div class="card-footer">
			<div class="float-end">
				<?= Html::activeSubmitButton($model) ?>
			</div>
			<div>
				<?= Html::formErrorSummary($model); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php $builder->endFooter(); ?>

	<?php
		$builder->render();
		$form->endForm(); //ActiveForm::end();
	?>
</div>
