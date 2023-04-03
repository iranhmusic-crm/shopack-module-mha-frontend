<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use iranhmusic\shopack\mha\frontend\common\models\MasterInsuranceModel;

class MemberSupplementaryInsDocHistoryModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberSupplementaryInsDocHistoryModelTrait;

	public static $resourceName = 'mha/member-supplementary-ins-doc-history';
  public static $primaryKey = 'mbrsinsdochstID';

	public function attributeLabels()
	{
		return [
			'mbrsinsdochstID'               => Yii::t('app', 'ID'),
			'mbrsinsdochstSupplementaryInsDocID'   => Yii::t('mha', 'Member Supplementary Insurance Document'),
			'mbrsinsdochstAction'           => Yii::t('app', 'Status'),
			'mbrsinsdochstCreatedAt'        => Yii::t('app', 'Created At'),
			'mbrsinsdochstCreatedBy'        => Yii::t('app', 'Created By'),
			'mbrsinsdochstCreatedBy_User'   => Yii::t('app', 'Created By'),
		];
	}

	public function isSoftDeleted()
  {
    return false;
  }

	public static function canCreate() {
		return true;
	}

	public function canUpdate() {
		return true;
	}

	public function canDelete() {
		return true;
	}

	public function canUndelete() {
		return false;
	}

	public function load($data, $formName = null) {
		$ret = parent::load($data, $formName);

		//load relations
		try {
      // $this->member->load($data);
      // $this->masterInsuranceType->load($data);
		} catch (\Throwable $exp) {}

		return $ret;
	}

}
