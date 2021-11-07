<?php

namespace Concrete\Package\CommunityStoreTwilioSms\Controller\SinglePage\Dashboard\Store;

use Concrete\Core\Support\Facade\Config;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Page\Controller\DashboardPageController;

class SmsNotifications extends DashboardPageController {

    public function view() {
        $this->set('pageTitle', t('SMS Notifications'));

        $app = Application::getFacadeApplication();

        $this->set('app', $app);

        if ($this->post()) {
            $args = $this->request->request->all();
            Config::save('community_store_twilio_sms.enabled', $args['enabled']);
            Config::save('community_store_twilio_sms.account_sid', $args['account_sid']);
            Config::save('community_store_twilio_sms.auth_token', $args['auth_token']);
            Config::save('community_store_twilio_sms.twilio_number', $args['twilio_number']);
            Config::save('community_store_twilio_sms.notification_number', $args['notification_number']);

            $this->flash('success', t('SMS Settings Updated'));
        }

        $this->set('enabled', Config::get('community_store_twilio_sms.enabled'));
        $this->set('account_sid', Config::get('community_store_twilio_sms.account_sid'));
        $this->set('auth_token', Config::get('community_store_twilio_sms.auth_token'));
        $this->set('twilio_number', Config::get('community_store_twilio_sms.twilio_number'));
        $this->set('notification_number', Config::get('community_store_twilio_sms.notification_number'));

    }

}
