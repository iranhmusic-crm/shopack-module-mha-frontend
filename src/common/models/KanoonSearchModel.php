<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use yii\base\Model;
use shopack\base\frontend\rest\RestClientDataProvider;
use iranhmusic\shopack\mha\frontend\common\models\KanoonModel;

class KanoonSearchModel extends KanoonModel
{
  use \shopack\base\common\db\SearchModelTrait;

	// public function attributeLabels()
	// {
	// 	return ArrayHelper::merge(parent::attributeLabels(), [
	// 		'usrssnLoginDateTime' => 'آخرین ورود',
	// 		'loginDateTime' => 'آخرین ورود',
	// 		'online' => 'آنلاین',
	// 	]);
	// }

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = self::find();

		$dataProvider = new RestClientDataProvider([
			'query' => $query,
			'sort' => [
				// 'enableMultiSort' => true,
				'attributes' => [
					'knnID',
					'knnName',
					'knnStatus',
					'knnCreatedAt' => [
						'default' => SORT_DESC,
					],
					'knnCreatedBy',
					'knnUpdatedAt' => [
						'default' => SORT_DESC,
					],
					'knnUpdatedBy',
					'knnRemovedAt' => [
						'default' => SORT_DESC,
					],
					'knnRemovedBy',
				],
			],
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$this->applySearchValuesInQuery($query);

		return $dataProvider;
	}

}
