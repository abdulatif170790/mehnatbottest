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
        sendMessage($chatId, "/get test!");
        break;
    case "/minimalka";
        sendMessage($chatId, "oylik ish haqi - 131000 so'm");
        break;
    default:
        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];
        $replay_markup = json_encode(compact('keyboard', 'resize_keyboard', 'one_time_keyboard', 'selective'));

//        sendMessage($chatId, "Iltimossss Komanda tanlang:\n/get - Malumot olish\n/minimalka - Eng kam oylik ish haqi");
        sendMessageReplayMarkup($chatId, $message, $replay_markup);
        break;
}


function sendMessage ($chat_id, $message){
    $url = $GLOBALS[website]."/sendMessage?chat_id=".$chat_id."&text=".urlencode($message);
    file_get_contents($url);
}

function sendMessageReplayMarkup ($chat_id, $text, $reply_markup ){
    $url = $GLOBALS[website]."/sendMessage?chat_id=".$chat_id."&text=".urlencode($text)."&parse_mode=null&disable_web_page_preview=false&reply_markup=".$reply_markup;
    file_get_contents($url);
}
?>