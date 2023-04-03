<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\common\enums\enuMemberMembershipStatus;

class MemberMembershipModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberMembershipModelTrait;

	public static $resourceName = 'mha/member-membership';
  public static $primaryKey = 'mbrshpID';

	public function attributeLabels()
	{
		return [
			'mbrshpMemberID'         => Yii::t('mha', 'Member'),
			'mbrshpMembershipID'     => Yii::t('mha', 'Membership'),
			'mbrshpStartDate'        => Yii::t('app', 'Start Date'),
			'mbrshpEndDate'          => Yii::t('app', 'End Date'),
			'mbrshpStatus'           => Yii::t('app', 'Status'),
			'mbrshpCreatedAt'        => Yii::t('app', 'Created At'),
			'mbrshpCreatedBy'        => Yii::t('app', 'Created By'),
			'mbrshpCreatedBy_User'   => Yii::t('app', 'Created By'),
			'mbrshpUpdatedAt'        => Yii::t('app', 'Updated At'),
			'mbrshpUpdatedBy'        => Yii::t('app', 'Updated By'),
			'mbrshpUpdatedBy_User'   => Yii::t('app', 'Updated By'),
		];
	}

	public function load($data, $formName = null) {
		$ret = parent::load($data, $formName);

		//load relations
		try {
      // $this->member->load($data);
      // $this->membership->load($data);
		} catch (\Throwable $exp) {}

		return $ret;
	}

	public function isSoftDeleted()
  {
    return false;
  }

	public static function canCreate() {
		return true;
	}

}
