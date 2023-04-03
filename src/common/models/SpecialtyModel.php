<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\common\enums\enuSpecialtyStatus;
use shopack\aaa\frontend\common\models\UserModel;
use shopack\base\common\validators\GroupRequiredValidator;

class SpecialtyModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\SpecialtyModelTrait;

	public static $resourceName = 'mha/specialty';
  public static $primaryKey = ['spcID'];

	public $parentid = null;
	public function getParentKey() {
		return $this->parentid;
	}

	public $fullName;

	public function attributeLabels()
	{
		return [
			'spcID'              => Yii::t('app', 'ID'),
			'spcRoot'            => Yii::t('app', 'Root'),
			'spcLeft'            => Yii::t('app', 'Left'),
			'spcRight'           => Yii::t('app', 'Right'),
			'spcLevel'           => Yii::t('app', 'Level'),
			'spcName'            => Yii::t('app', 'Name'),
			'spcDesc'            => Yii::t('app', 'Desc'),
			'spcStatus'          => Yii::t('app', 'Status'),
			'spcCreatedAt'       => Yii::t('app', 'Created At'),
			'spcCreatedBy'       => Yii::t('app', 'Created By'),
			'spcCreatedBy_User'  => Yii::t('app', 'Created By'),
			'spcUpdatedAt'       => Yii::t('app', 'Updated At'),
			'spcUpdatedBy'       => Yii::t('app', 'Updated By'),
			'spcUpdatedBy_User'  => Yii::t('app', 'Updated By'),
			'spcRemovedAt'       => Yii::t('app', 'Removed At'),
			'spcRemovedBy'       => Yii::t('app', 'Removed By'),
			'spcRemovedBy_User'  => Yii::t('app', 'Removed By'),
		];
	}

	public function isSoftDeleted()
  {
    return ($this->spcStatus == enuSpecialtyStatus::REMOVED);
  }

	public static function canCreate() {
		return true;
	}

	public function canUpdate() {
		return ($this->spcStatus != enuSpecialtyStatus::REMOVED);
	}

	public function canDelete() {
		return ($this->spcStatus != enuSpecialtyStatus::REMOVED);
	}

	public function canUndelete() {
		return ($this->spcStatus == enuSpecialtyStatus::REMOVED);
	}

}
