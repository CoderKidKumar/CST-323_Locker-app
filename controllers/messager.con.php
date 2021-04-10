<?php
require '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class messager
{
    public function newDebugMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('DEBUG-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->debug("Message from messager.debug: " . $message);
    }
    public function newInfoMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('INFO-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->info("Message from messager.info: " . $message);
    }
    public function newNoticeMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('NOTICE-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->notice("Message from messager.notice: " . $message);
    }
    public function newWarningMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('WARNING-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->warning("Message from messager.warning: " . $message);
    }
    public function newErrorMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('ERROR-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->error("Message from messager.error: " . $message);
    }
    public function newCriticalMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('CRITICAL-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->critical("Message from messager.critical: " . $message);
    }

    public function newAlertMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('ALERT-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->alert("Message from messager.alert: " . $message);
    }
    public function newEmergencyMessage(String $filename, String $message)
    {
        // create a log channel
        $logger = new Logger('EMERGENCY-FROM: ' . $filename);
        $logger->pushHandler(new StreamHandler('../app.log', Logger::DEBUG));
        $logger->emergency("Message from messager.emergency: " . $message);
    }
}
