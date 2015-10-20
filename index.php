<?php

ini_set('error_reporting', E_ALL);

$botToken = "148278479:AAFPMVrxoSPQG3xC1FUFvQL3nNgDOvZ1h-8";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents("php://input");
echo $update;
$updateArray = json_decode($update, TRUE);

$chatId = $updateArray['message']['chat']['id'];
$message = $updateArray['message']['text'];

switch($message){

    case "/get":
        sendMessage($chatId, "Biror bir malumot junatiladi!");
        break;
    case "/minimalka";
        sendMessage($chatId, "Bugungi kunda eng kam oylik ish haqi - 131000 so'm");
        break;
    default:
        sendMessage($chatId, "Komanda tanlang:\n/get - Malumot olish\n/minimalka - Eng kam oylik ish haqi");
        break;
}


function sendMessage ($chat_id, $message){
    $url = $GLOBALS[website]."/sendMessage?chat_id=".$chat_id."&text=".urlencode($message);
    file_get_contents($url);
}

?>