<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\common\enums\enuMemberDocumentStatus;

class MemberDocumentModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberDocumentModelTrait;

	public static $resourceName = 'mha/member-document';
  public static $primaryKey = 'mbrdocID';

	public function attributeLabels()
	{
		return [
			'mbrdocMemberID'         => Yii::t('mha', 'Member'),
			'mbrdocDocumentID'       => Yii::t('mha', 'Document'),
			'mbrdocFileID'           => Yii::t('app', 'File'),
			'mbrdocStatus'           => Yii::t('app', 'Status'),
			'mbrdocCreatedAt'        => Yii::t('app', 'Created At'),
			'mbrdocCreatedBy'        => Yii::t('app', 'Created By'),
			'mbrdocCreatedBy_User'   => Yii::t('app', 'Created By'),
			'mbrdocUpdatedAt'        => Yii::t('app', 'Updated At'),
			'mbrdocUpdatedBy'        => Yii::t('app', 'Updated By'),
			'mbrdocUpdatedBy_User'   => Yii::t('app', 'Updated By'),
		];
	}

	public function load($data, $formName = null) {
		$ret = parent::load($data, $formName);

		//load relations
		try {
      // $this->member->load($data);
      // $this->document->load($data);
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
