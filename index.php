<?php

ini_set('error_reporting', E_ALL);
require 'TelegramAPI.php';

$tg = new TelegramAPI();


$chat_id = null;
$guessed = false;
$sendQuestion = false;

$data = $tg->getWebhookUpdates();
$chat_id = $data['message']['chat']['id'];
$text = $data['message']['text'];

$tg->sendChatAction($chat_id, "javobni kuting...");
$result = json_decode(file_get_contents('http://mehnat.uz/mehnatbot/mehnatbot.php'));


if ($text == "/minimalka") {
    $tg->sendMessage($chat_id, "Hozirgi kunda eng kam oylik ish haqi - ".$result['zarplata']." so'm");
}


elseif ($tg->startsWith($text, "/maosh")) {

    $string = "Maosh hisoblash uchun quyidagi ko'rinishda kiriting (1-21): \nMasalan: \n /maosh 7";

    if ($text == "/maosh") $tg->sendMessage($chat_id, $string);
    else {
        $r = substr_replace($text, '', 0, 5);
        $number = (int)$r;
        if ($number >= 0 && $number <= 22) {
            $r1 = $result['razryad'][$number]['razryad'];
            $k1 = $result['razryad'][$number]['koef'];
            $tg->sendMessage($chat_id, "Razryad - ".$r1."\n Koeffitsient tarif - ".$k1."\n Sizning maoshingiz: ".($r1*$k1)." so'm");

        } else $tg->sendMessage($chat_id, "Siz noto'g'ri razryad kiritdingiz:\n\n" . $string);
    }

}
else{
    $tg->sendMessage($chat_id, json_encode($result));
}


//    case 'Q':
//        $keyboard = [
//            ['7', '8', '9'],
//            ['4', '5', '6'],
//            ['1', '2', '3'],
//            ['0']
//        ];
//        $reply_markup = $tg->replyKeyboardMarkup($keyboard, true, true);
//        $tg->sendMessage($chat_id, $text, false, null, $reply_markup);
//        break;
//    case "W":
//        $reply_markup = $tg->replyKeyboardHide();
//        $tg->sendMessage($chat_id, $text, false, null, $reply_markup);
//        break;
//    case "E":
//        $reply_markup = $tg->forceReply();
//        $tg->sendMessage($chat_id, $text, false, null, $reply_markup);
//        break;
//    default:
//        $tg->sendMessage($chat_id, $chat_id.$text);
//        break;
//}


//// Custom keyboard
//$customKeyboard = [
//    ['7', '8', '9'],
//    ['4', '5', '6'],
//    ['1', '2', '3'],
//    ['0']
//];
//
//$reply_markup = $tg->replyKeyboardMarkup($customKeyboard, true, true);
//
////do {
//    $data = $tg->getWebhookUpdates();
//    if(isset($data)) {
//        if (is_null($chat_id))
//            $chat_id = $data['message']['chat']['id'];
//
//        if (!$sendQuestion) {
//            $tg->sendChatAction($chat_id, 'typing');
//            $tg->sendMessage($chat_id, 'Guess the number', false, null, $reply_markup);
//            $sendQuestion = true;
//        }
//
//        if (($data['message']['text']) == 5) {
//            $tg->sendChatAction($chat_id, 'typing');
//            $tg->sendMessage($chat_id, 'You did it! :)');
//            $tg->sendChatAction($chat_id, 'upload_photo');
////            $tg->sendPhoto($chat_id, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/718smiley.png/220px-718smiley.png');
//            $guessed = true;
//        } else
//            $tg->sendMessage($chat_id, 'Wrong number :/ try again', false, null, $reply_markup);
//    }
//} while (!$guessed);

//$data = $tg->getWebhookUpdates();

?>