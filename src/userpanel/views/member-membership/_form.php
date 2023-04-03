<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

use shopack\base\frontend\helpers\Html;
use shopack\base\frontend\widgets\ActiveForm;
use shopack\base\frontend\widgets\FormBuilder;
use shopack\base\frontend\widgets\datetime\DatePicker;
?>

<div class='member-membership-form'>
	<?php
		$form = ActiveForm::begin([
			'model' => $model,
			'formConfig' => [
				'labelSpan' => 4,
			],
		]);

		$builder = $form->getBuilder();

		// $builder->fields([
		// 	[
		// 		'mbrshpMemberID',
		// 		'type' => FormBuilder::FIELD_STATIC,
		// 		'staticValue' => $model->member->user->displayName(),
		// 	],
		// ]);

		$builder->fields([
			[
				'mbrshpStartDate',
				'type' => FormBuilder::FIELD_WIDGET,
				'widget' => DatePicker::class,
				'fieldOptions' => [
					'addon' => [
						'append' => [
							'content' => '<i class="far fa-calendar-alt"></i>',
						],
					],
				],
			],
			// 'mbrshpEndDate',
			// [
			// 	'mbrshpStatus',
			// 	'type' => FormBuilder::FIELD_WIDGET,
			// 	'widget' => Select2::class,
			// 	'widgetOptions' => [
			// 		'data' => enuMemberMembershipStatus::getList(),
			// 		'options' => [
			// 			'placeholder' => Yii::t('app', '-- Choose --'),
			// 			'dir' => 'rtl',
			// 		],
			// 	],
			// ],

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
