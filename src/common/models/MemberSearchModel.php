<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use yii;
use yii\base\Model;
use shopack\base\frontend\rest\RestClientDataProvider;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use shopack\base\common\helpers\ArrayHelper;

class MemberSearchModel extends MemberModel
{
  use \shopack\base\common\db\SearchModelTrait;

	const FILTER_MODE_ALL												= 0;
	const FILTER_MODE_WAIT_FOR_BASE_APPROVAL		= 1;
	const FILTER_MODE_WAIT_FOR_KANOON_APPROVAL	= 2;

	public $filter_mode;

	public function extraRules()
	{
		return [
			[[
				'filter_mode',
			], 'number'],
			[[
				'filter_mode',
			], 'default', 'value' => 0],
		];
	}

	public function attributeLabels()
	{
		return ArrayHelper::merge(parent::attributeLabels(), [
			'filter_mode' => Yii::t('app', 'Status'),
		]);
	}

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params)
	{
		$this->load($params);

		$query = self::find();

		$dataProvider = new RestClientDataProvider([
			'query' => $query,
			'sort' => [
				// 'enableMultiSort' => true,
				'attributes' => [
					'mbrUserID',
					'mbrRegisterCode',
					'mbrAcceptedAt' => [
						'default' => SORT_DESC,
					],
					'mbrStatus',
					'mbrCreatedAt' => [
						'default' => SORT_DESC,
					],
					'mbrCreatedBy',
					'mbrUpdatedAt' => [
						'default' => SORT_DESC,
					],
					'mbrUpdatedBy',
					'mbrRemovedAt' => [
						'default' => SORT_DESC,
					],
					'mbrRemovedBy',
				],
			],
		]);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$this->applySearchValuesInQuery($query);

		switch ($this->filter_mode)
		{
			case self::FILTER_MODE_ALL:
				break;

			case self::FILTER_MODE_WAIT_FOR_BASE_APPROVAL:
				$dataProvider->query
					->andWhere('IFNULL(shpobjPrice, 0) > 0')
				;
				break;

			case self::FILTER_MODE_WAIT_FOR_KANOON_APPROVAL:
				$dataProvider->query
					->andWhere('IFNULL(shpobjPrice, 0) = 0')
				;
				break;
		}

		return $dataProvider;
	}

}
