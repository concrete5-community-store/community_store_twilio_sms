<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php $form = $app->make('helper/form'); ?>

<form action="<?= \Concrete\Core\Support\Facade\Url::to('/dashboard/store/sms_notifications')?>" method="post">

    <div class="form-group">
        <?= $form->label('experience',t("Enabled")); ?>
        <?php echo $form->select('enabled', ['0'=>t('Disabled'), '1'=>t('Enabled')], $enabled); ?>
    </div>

    <div class="form-group">
        <?= $form->label('notification_number',t("Notification Phone Number")); ?>
        <?= $form->text('notification_number', $notification_number, ['placeholder'=>t('Include Country Code, e.g. +1')]); ?>
    </div>

    <hr />

    <h4><?= t('Twilio Account');?></h4>

    <div class="form-group">
        <?= $form->label('account_sid',t("Account SID")); ?>
        <?= $form->text('account_sid', $account_sid); ?>
    </div>

    <div class="form-group">
        <?= $form->label('auth_token',t("Auth Token")); ?>
        <?= $form->text('auth_token', $auth_token); ?>
    </div>

    <div class="form-group">
        <?= $form->label('experience',t("Twilio Number")); ?>
        <?= $form->text('twilio_number', $twilio_number, ['placeholder'=>t('Include Country Code, e.g. +1')]); ?>
    </div>





    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right float-right btn btn-primary" type="submit" ><?= t('Save Settings')?></button>
        </div>
    </div>

</form>
