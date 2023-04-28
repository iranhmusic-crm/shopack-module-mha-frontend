<?php
/**
 * @author Kambiz Zandi <kambizzandi@gmail.com>
 */

/** @var yii\web\View $this */

use shopack\base\frontend\widgets\PopoverX;
use shopack\base\common\helpers\Url;
use shopack\base\common\helpers\ArrayHelper;
use shopack\base\frontend\widgets\tabs\Tabs;
use shopack\base\frontend\widgets\DetailView;
use shopack\base\frontend\helpers\Html;
use shopack\aaa\common\enums\enuUserStatus;
use shopack\aaa\common\enums\enuGender;
use iranhmusic\shopack\mha\common\enums\enuMemberStatus;
use iranhmusic\shopack\mha\frontend\common\models\MemberModel;

$this->title = Yii::t('mha', 'Member') . ': ' . $model->user->displayName();
$this->params['breadcrumbs'][] = Yii::t('mha', 'Music House');
$this->params['breadcrumbs'][] = ['label' => Yii::t('mha', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="member-view w-100">
  <div class='card border-default'>
		<div class='card-header bg-default'>
			<div class="float-end">
				<?= MemberModel::canCreate() ? Html::createButton() : '' ?>
        <?php
          if ($model->canUpdate()) {
            echo Html::a(Yii::t('mha', 'Update User'), [
              '/aaa/user/update',
              'id' => $model->mbrUserID,
              'ref' => Url::to(['view', 'id' => $model->mbrUserID], true)
            ], [
              'modal' => true,
              'class' => 'btn btn-sm btn-primary',
            ]);
          }
        ?>
        <?= $model->canUpdate()   ? Html::updateButton(null,   ['id' => $model->mbrUserID]) : '' ?>
        <?= $model->canDelete()   ? Html::deleteButton(null,   ['id' => $model->mbrUserID]) : '' ?>
        <?= $model->canUndelete() ? Html::undeleteButton(null, ['id' => $model->mbrUserID]) : '' ?>
        <?php
          PopoverX::begin([
            // 'header' => 'Hello world',
            'closeButton' => false,
            'toggleButton' => [
              'label' => Yii::t('aaa', 'Logs'),
              'class' => 'btn btn-default',
            ],
            'placement' => PopoverX::ALIGN_AUTO_BOTTOM,
          ]);

          echo DetailView::widget([
            'model' => $model,
            'enableEditMode' => false,
            'attributes' => [
              'mbrCreatedAt:jalaliWithTime',
              [
                'attribute' => 'mbrCreatedBy_User',
                'value' => $model->createdByUser->actorName ?? '-',
              ],
              'mbrUpdatedAt:jalaliWithTime',
              [
                'attribute' => 'mbrUpdatedBy_User',
                'value' => $model->updatedByUser->actorName ?? '-',
              ],
              'mbrRemovedAt:jalaliWithTime',
              [
                'attribute' => 'mbrRemovedBy_User',
                'value' => $model->removedByUser->actorName ?? '-',
              ],
            ],
          ]);

          PopoverX::end();
        ?>
			</div>
      <div class='card-title'><?= Html::encode($this->title) ?></div>
			<div class="clearfix"></div>
		</div>

    <div class='card-tabs'>
  		<?php $tabs = Tabs::begin($this); ?>

      <?php $tabs->beginTabPage('مشخصات'); ?>
        <div class='row'>
          <div class='col-8'>
            <?php
              echo DetailView::widget([
                'model' => $model,
                'enableEditMode' => false,
                'cols' => 2,
                'isVertical' => false,
                'attributes' => [
                  [
                    'attribute' => 'mbrUserID',
                    'format' => 'raw',
                    'value' => Html::a($model->user->displayName(), ['/aaa/user/view', 'id' => $model->mbrUserID], ['class' => ['btn', 'btn-sm', 'btn-outline-secondary']]),
                  ],
                  [
                    'attribute' => 'usrStatus',
                    'value' => enuUserStatus::getLabel($model->user->usrStatus),
                  ],
                  'mbrRegisterCode',
                  [
                    'attribute' => 'mbrStatus',
                    'value' => enuMemberStatus::getLabel($model->mbrStatus),
                  ],
                  'mbrAcceptedAt:jalaliWithTime',
                  [
                    'group' => true,
                    // 'cols' => 1,
                    'label' => 'اطلاعات پایه',
                  ],
                  [
                    'attribute' => 'usrEmail',
                    'valueColOptions' => ['class' => ['dir-ltr', 'text-start']],
                    'value' => $model->user->usrEmail,
                  ],
                  [
                    'attribute' => 'usrEmailApprovedAt',
                    'format' => 'jalaliWithTime',
                    'value' => $model->user->usrEmailApprovedAt,
                  ],
                  [
                    'attribute' => 'usrMobile',
                    'valueColOptions' => ['class' => ['dir-ltr', 'text-start']],
                    'value' => $model->user->usrMobile,
                  ],
                  [
                    'attribute' => 'usrMobileApprovedAt',
                    'format' => 'jalaliWithTime',
                    'value' => $model->user->usrMobileApprovedAt,
                  ],
                  [
                    'attribute' => 'usrSSID',
                    'value' => $model->user->usrSSID,
                  ],
                  [
                    'attribute' => 'usrGender',
                    'value' => enuGender::getLabel($model->usrGender),
                  ],
                  [
                    'attribute' => 'usrFirstName',
                    'value' => $model->user->usrFirstName,
                  ],
                  [
                    'attribute' => 'usrFirstName_en',
                    'value' => $model->user->usrFirstName_en,
                  ],
                  [
                    'attribute' => 'usrLastName',
                    'value' => $model->user->usrLastName,
                  ],
                  [
                    'attribute' => 'usrLastName_en',
                    'value' => $model->user->usrLastName_en,
                  ],
                ],
              ]);
            ?>
          </div>
          <div class='col-4'>
          <?php
            ?>
          </div>
        </div>

        <p>&nbsp;</p>

        <div>
          <?php
            echo DetailView::widget([
              'model' => $model,
              'enableEditMode' => false,
              'attributes' => [
                [
                  'group' => true,
                  'label' => 'اطلاعات تکمیلی',
                ],
                'mbrMusicExperiences',
                'mbrMusicExperienceStartAt:jalali',
                'mbrArtHistory',
                'mbrMusicEducationHistory',
              ],
            ]);
          ?>
        </div>
      <?php $tabs->endTabPage(); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Documents'), [
          '/mha/member-document/index',
          'mbrdocMemberID' => $model->mbrUserID,
        ],
        'member-documents'
      ); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Specialties'), [
          '/mha/member-specialty/index',
          'mbrspcMemberID' => $model->mbrUserID,
        ],
        'member-specialty'
      ); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Kanoons'), [
          '/mha/member-kanoon/index',
          'mbrknnMemberID' => $model->mbrUserID,
        ],
        'member-kanoons'
      ); ?>

      <?php
        $tabs->beginTabPage(Yii::t('mha', 'Insurance'), [
          'member-master-insurances',
          'member-master-ins-docs',
          'member-supplementary-ins-docs',
        ]);

        $tabs2 = Tabs::begin($this, [
          'pluginOptions' => [
            'id' => 'tabs_insurances',
            // 'position' => \kartik\tabs\TabsX::POS_LEFT,
            // 'bordered' => true,
          ],
        ]);

        $tabs2->newAjaxTabPage(Yii::t('mha', 'Master Insurances'), [
            '/mha/member-master-insurance/index',
            'mbrminshstMemberID' => $model->mbrUserID,
          ],
          'member-master-insurances'
        );

        //use runaction for proper loading grid expand column
        $tabs2->beginTabPage(Yii::t('mha', 'Master Insurance Documents'), 'member-master-ins-docs');
        echo Yii::$app->runAction('/mha/member-master-ins-doc/index', ArrayHelper::merge($_GET, [
          'isPartial' => true,
          'params' => [
            'mbrminsdocMemberID' => $model->mbrUserID,
          ],
        ]));
        $tabs2->endTabPage();

        // $tabs2->newAjaxTabPage(Yii::t('mha', 'Master Insurance Documents'), [
        //     '/mha/member-master-ins-doc/index',
        //     'mbrminsdocMemberID' => $model->mbrUserID,
        //   ],
        //   'member-master-ins-docs'
        // );

        //use runaction for proper loading grid expand column
        $tabs2->beginTabPage(Yii::t('mha', 'Supplementary Insurance Documents'), 'member-supplementary-ins-docs');
        echo Yii::$app->runAction('/mha/member-supplementary-ins-doc/index', ArrayHelper::merge($_GET, [
          'isPartial' => true,
          'params' => [
            'mbrsinsdocMemberID' => $model->mbrUserID,
          ],
        ]));
        $tabs2->endTabPage();

        // $tabs2->newAjaxTabPage(Yii::t('mha', 'Supplementary Insurance Documents'), [
        //     '/mha/member-supplementary-ins-doc/index',
        //     'mbrsinsdocMemberID' => $model->mbrUserID,
        //   ],
        //   'member-supplementary-ins-docs'
        // );

        $tabs2->end();

        $tabs->endTabPage();
      ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Sponsorships'), [
          '/mha/member-sponsorship/index',
          'mbrspsMemberID' => $model->mbrUserID,
        ],
        'member-sponsorships'
      ); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Memberships'), [
          '/mha/member-membership/index',
          'mbrshpMemberID' => $model->mbrUserID,
        ],
        'member-memberships'
      ); ?>

      <?php $tabs->newAjaxTabPage(Yii::t('mha', 'Financials'), [
          '/mha/member-financial/index',
          'finUserID' => $model->mbrUserID,
        ],
        'financials'
      ); ?>

      <?php $tabs->end(); ?>
    </div>
  </div>
</div>
