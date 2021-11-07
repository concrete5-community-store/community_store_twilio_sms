<?php
namespace Concrete\Package\CommunityStoreTwilioSms\Event;

use Concrete\Core\Support\Facade\Log;
use Concrete\Core\Support\Facade\Config;
use Concrete\Core\Support\Facade\Application;

class Order
{
    public function orderPlaced($event)
    {
        $enabled = Config::get('community_store_twilio_sms.enabled');
        $account_sid = Config::get('community_store_twilio_sms.account_sid');
        $auth_token = Config::get('community_store_twilio_sms.auth_token');
        $twilio_number = Config::get('community_store_twilio_sms.twilio_number');
        $notification_number = Config::get('community_store_twilio_sms.notification_number');

        if ($enabled && $account_sid && $auth_token && $twilio_number && $notification_number) {
            $order = $event->getOrder();

            $app = Application::getFacadeApplication();
            $request = $app->make(\Concrete\Core\Http\Request::class);
            $host = $request->getHost();


            $company = $order->getAttribute('billing_company');
            $orderName = $order->getAttribute('billing_first_name') . ' '  . $order->getAttribute('billing_last_name');

            if ($company) {
                $orderName .= ' (' . $company . ')';
            }

            try {
                $client = new \Twilio\Rest\Client($account_sid, $auth_token);
                $client->messages->create(
                    $notification_number,
                    [
                        'from' => $twilio_number,
                        'body' => t('Order #%s has been placed at %s by %s', $order->getOrderID(), $host, $orderName)
                    ]
                );
            } catch (\Exception $e) {
                Log::addWarning(t('Community Store Twilio SMS: failed sending to %s, with error %s', $twilio_number, $e->getMessage()));
            }
        }
    }

}
