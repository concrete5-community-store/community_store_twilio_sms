<?php
namespace Concrete\Package\CommunityStoreTwilioSms;

use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Events;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Support\Facade\Application;

class Controller extends Package
{
    protected $pkgHandle = 'community_store_twilio_sms';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '1.0';
    protected $packageDependencies = ['community_store'=>'2.0'];

    protected $pkgAutoloaderRegistries = [
        'src/CommunityStoreTwilioSms' => '\Concrete\Package\CommunityStoreTwilioSms',
    ];

    public function getPackageDescription()
    {
        return t("Twilio SMS notifications for Community Store");
    }

    public function getPackageName()
    {
        return t("Community Store Twilio SMS Notifications");
    }

    public function install()
    {
        $pkg = parent::install();

        $page = SinglePage::add('/dashboard/store/sms_notifications',$pkg);
        $data = array('cName' => 'SMS Notifications');
        $page->update($data);
    }

    public function on_start()
    {
        require __DIR__ . '/vendor/autoload.php';
        $app = Application::getFacadeApplication();

        // orders
        $orderListener = $app->make('\Concrete\Package\CommunityStoreTwilioSms\Event\Order');
        Events::addListener('on_community_store_order', array($orderListener, 'orderPlaced'));

    }
}
