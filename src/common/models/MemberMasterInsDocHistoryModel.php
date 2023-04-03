<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use iranhmusic\shopack\mha\frontend\common\models\MasterInsuranceModel;

class MemberMasterInsDocHistoryModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberMasterInsDocHistoryModelTrait;

	public static $resourceName = 'mha/member-master-ins-doc-history';
  public static $primaryKey = 'mbrminsdochstID';

	public function attributeLabels()
	{
		return [
			'mbrminsdochstID'               => Yii::t('app', 'ID'),
			'mbrminsdochstMasterInsDocID'   => Yii::t('mha', 'Member Master Insurance Document'),
			'mbrminsdochstAction'           => Yii::t('app', 'Status'),
			'mbrminsdochstCreatedAt'        => Yii::t('app', 'Created At'),
			'mbrminsdochstCreatedBy'        => Yii::t('app', 'Created By'),
			'mbrminsdochstCreatedBy_User'   => Yii::t('app', 'Created By'),
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
