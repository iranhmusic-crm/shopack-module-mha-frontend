<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

use shopack\base\frontend\helpers\Html;

$this->title = Yii::t('mha', 'Update Document');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id='member-document-update' class='d-flex justify-content-center'>
	<div class='w-sm-75 card border-primary'>

		<div class='card-header bg-primary text-white'>
			<div class='card-title'><?= Html::encode($this->title) ?></div>
		</div>

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>
</div>
