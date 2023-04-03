<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

namespace iranhmusic\shopack\mha\frontend\common\models;

use Yii;
use shopack\base\frontend\rest\RestClientActiveRecord;
use iranhmusic\shopack\mha\common\enums\enuMemberStatus;
use shopack\aaa\frontend\common\models\UserModel;
use shopack\base\common\validators\GroupRequiredValidator;

class MemberModel extends RestClientActiveRecord
{
	use \iranhmusic\shopack\mha\common\models\MemberModelTrait;

	public static $resourceName = 'mha/member';
  public static $primaryKey = ['mbrUserID'];

	public $mbrCreateNewUser = false;

	public $usrGender;
	public $usrFirstName;
	public $usrFirstName_en;
	public $usrLastName;
	public $usrLastName_en;
	public $usrEmail;
	public $usrMobile;
	public $usrSSID;

	public function extraRules() {
		return [
			['mbrCreateNewUser', 'boolean'],

			['mbrUserID',
				'required',
				'when' => function ($model) {
					return ($model->mbrCreateNewUser == false);
				},
				'whenClient' => "function (attribute, value) {
					return ($('#membermodel-mbrcreatenewuser')[0].checked == false);
				}"
			],

			[['usrEmail',
  			'usrMobile',
	  		'usrSSID',
				'usrGender',
				'usrFirstName',
				'usrFirstName_en',
				'usrLastName',
        'usrLastName_en',
			], 'string'],

      // [[
      //   'usrEmail',
      //   'usrMobile',
      // ], GroupRequiredValidator::class,
      //   'min' => 1,
      //   'in' => [
      //     'usrEmail',
      //     'usrMobile',
      //   ],
      //   'message' => Yii::t('aaa', 'one of email or mobile is required'),
			// 	'when' => function ($model) {
			// 		return ($model->mbrCreateNewUser);
			// 	},
			// 	'whenClient' => "function (attribute, value) {
			// 		return $('#membermodel-mbrcreatenewuser')[0].checked;
			// 	}"
      // ],

			[[
        'usrMobile',
        'usrSSID',
				'usrFirstName',
				'usrFirstName_en',
        'usrLastName',
        'usrLastName_en',
      ], 'required',
				'when' => function ($model) {
					return ($model->mbrCreateNewUser);
				},
				'whenClient' => "function (attribute, value) {
					return $('#membermodel-mbrcreatenewuser')[0].checked;
				}"
      ],

		];
	}

	public function attributeLabels()
	{
		return [
			'mbrCreateNewUser'          => Yii::t('mha', 'Create new user'),
			'mbrUserID'                 => Yii::t('mha', 'Related User'),
			'mbrRegisterCode'           => Yii::t('mha', 'Register Code'),
			'mbrAcceptedAt'							=> Yii::t('mha', 'Registration Accepted At'),
			'mbrMusicExperiences'       => Yii::t('mha', 'Music Experiences'),
			'mbrMusicExperienceStartAt' => Yii::t('mha', 'Music Experience Start At'),
			'mbrArtHistory'             => Yii::t('mha', 'Art History'),
			'mbrMusicEducationHistory'  => Yii::t('mha', 'Music Education History'),
			'mbrStatus'                 => Yii::t('mha', 'Member Status'),
			'mbrCreatedAt'              => Yii::t('app', 'Created At'),
			'mbrCreatedBy'              => Yii::t('app', 'Created By'),
			'mbrCreatedBy_User'         => Yii::t('app', 'Created By'),
			'mbrUpdatedAt'              => Yii::t('app', 'Updated At'),
			'mbrUpdatedBy'              => Yii::t('app', 'Updated By'),
			'mbrUpdatedBy_User'         => Yii::t('app', 'Updated By'),
			'mbrRemovedAt'              => Yii::t('app', 'Removed At'),
			'mbrRemovedBy'              => Yii::t('app', 'Removed By'),
			'mbrRemovedBy_User'         => Yii::t('app', 'Removed By'),

			'usrStatus'            => Yii::t('aaa', 'User Status'),
      'usrGender'            => Yii::t('aaa', 'Gender'),
      'usrFirstName'         => Yii::t('aaa', 'First Name'),
      'usrFirstName_en'      => Yii::t('aaa', 'First Name (en)'),
      'usrLastName'          => Yii::t('aaa', 'Last Name'),
      'usrLastName_en'       => Yii::t('aaa', 'Last Name (en)'),
      'usrEmail'             => Yii::t('aaa', 'Email'),
      'usrEmailApprovedAt'   => Yii::t('aaa', 'Email Approved At'),
      'usrMobile'            => Yii::t('aaa', 'Mobile'),
      'usrMobileApprovedAt'  => Yii::t('aaa', 'Mobile Approved At'),
      'usrSSID'              => Yii::t('aaa', 'SSID'),
      'usrRoleID'            => Yii::t('aaa', 'Role'),
      'usrPrivs'             => Yii::t('aaa', 'Privs'),
      'usrPassword'          => Yii::t('aaa', 'Password'),
      'usrRetypePassword'    => Yii::t('aaa', 'Retype Password'),
      'usrPasswordHash'      => Yii::t('aaa', 'Password Hash'),
      'usrPasswordCreatedAt' => Yii::t('aaa', 'Password Created At'),

		];
	}

	public function isSoftDeleted()
  {
    return ($this->mbrStatus == enuMemberStatus::REMOVED);
  }

	public static function canCreate() {
		return true;
	}

	public function canUpdate() {
		return ($this->mbrStatus != enuMemberStatus::REMOVED);
	}

	public function canDelete() {
		return ($this->mbrStatus != enuMemberStatus::REMOVED);
	}

	public function canUndelete() {
		return ($this->mbrStatus == enuMemberStatus::REMOVED);
	}

	public function getUser() {
		return $this->hasOne(UserModel::class, ['usrID' => 'mbrUserID']);
	}

	public function load($data, $formName = null) {
		$ret = parent::load($data, $formName);

		//load relations
		try {
      $this->user->load($data);
		} catch (\Throwable $exp) {}

		return $ret;
	}

	public function save($runValidation = true, $attributeNames = null) {
		if ($this->isNewRecord) {
			if ($this->mbrCreateNewUser) {
				$userModel = new UserModel();

				$userModel->usrGender        = $this->usrGender;
				$userModel->usrFirstName     = $this->usrFirstName;
				$userModel->usrFirstName_en  = $this->usrFirstName_en;
				$userModel->usrLastName      = $this->usrLastName;
				$userModel->usrLastName_en   = $this->usrLastName_en;
				$userModel->usrSSID          = $this->usrSSID;
				$userModel->usrMobile        = $this->usrMobile;
				$userModel->usrEmail         = $this->usrEmail;

				$done = $userModel->save();
				if (!$done) {
					$this->addErrors($userModel->getErrors());
					return false;
				}
				$this->mbrCreateNewUser = false;
				$this->mbrUserID = $userModel->usrID;

				$this->usrGender        = null;
				$this->usrFirstName     = null;
				$this->usrFirstName_en  = null;
				$this->usrLastName      = null;
				$this->usrLastName_en   = null;
				$this->usrSSID          = null;
				$this->usrMobile        = null;
				$this->usrEmail         = null;

				// unset($this['user']);
				// // $this->populateRelation('user', null);
			}
		}

		try {
			return parent::save($runValidation, $attributeNames);
		} catch (\Throwable $exp) {
			$this->addError(null, $exp->getMessage());
		}

		return false;
	}

	public function displayName()
	{
		$result = '';

		if ($this->mbrRegisterCode)
			$result = $this->mbrRegisterCode . ': ';

		return $result . '[' . $this->user->displayName('{fn} {ln} {em} {mob}') . ']';
	}

}
