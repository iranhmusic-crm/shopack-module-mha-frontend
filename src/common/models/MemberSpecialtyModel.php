<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;
use iranhmusic\shopack\mha\frontend\common\models\SpecialtyModel;

class MemberSpecialtyModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberSpecialtyModelTrait;

	public static $resourceName = 'mha/member-specialty';
  public static $primaryKey = ['mbrspcMemberID', 'mbrspcSpecialtyID'];

	public function attributeLabels()
	{
		return [
			'mbrspcMemberID'         => Yii::t('mha', 'Member'),
			'mbrspcSpecialtyID'      => Yii::t('mha', 'Specialty'),
			'mbrspcDesc'             => Yii::t('app', 'Description'),
			'mbrspcCreatedAt'        => Yii::t('app', 'Created At'),
			'mbrspcCreatedBy'        => Yii::t('app', 'Created By'),
			'mbrspcCreatedBy_User'   => Yii::t('app', 'Created By'),
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

	public function getMember() {
		return $this->hasOne(MemberModel::class, ['mbrUserID' => 'mbrspcMemberID']);
	}

	public function getSpecialty() {
		return $this->hasOne(SpecialtyModel::class, ['spcID' => 'mbrspcSpecialtyID']);
	}

	public function load($data, $formName = null) {
		$ret = parent::load($data, $formName);

		//load relations
		try {
      // $this->member->load($data);
      // $this->specialty->load($data);
		} catch (\Throwable $exp) {}

		return $ret;
	}

}
