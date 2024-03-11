<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require __DIR__ . "/vendor/autoload.php";

$number = $_POST["number"];
$message = $_POST["message"];

if ($_POST["provider"] === "infobip") {

    $base_url = "y36gx1.api.infobip.com";
    $api_key = "814b1cc51e2ea075dd6702a598bec3d9-4b16e4ae-52f7-4a32-ac0d-d0e2e7b0b455";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);

    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $number);

    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "daveh"
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    $response = $api->sendSmsMessage($request);

} 

echo "Message sent.";