<h2> Salom</h2>

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


$tg->sendChatAction($chat_id, "natijani kuting...");
//$result = (array)json_decode(file_get_contents('http://mehnat.uz/mehnatbot/mehnatbot.php'));
$result = (array)json_decode('{"zarplata":"131300","razryad":[{"id":"9","razryad":"1","koef":"2.476"},{"id":"10","razryad":"2","koef":"2.725"},{"id":"11","razryad":"3","koef":"2.998"},{"id":"12","razryad":"4","koef":"3.297"},{"id":"13","razryad":"5","koef":"3.612"},{"id":"14","razryad":"6","koef":"3.941"},{"id":"15","razryad":"7","koef":"4.284"},{"id":"16","razryad":"8","koef":"4.64"},{"id":"17","razryad":"9","koef":"4.997"},{"id":"18","razryad":"10","koef":"5.362"},{"id":"19","razryad":"11","koef":"5.733"},{"id":"20","razryad":"12","koef":"6.115"},{"id":"21","razryad":"13","koef":"6.503"},{"id":"22","razryad":"14","koef":"6.893"},{"id":"23","razryad":"15","koef":"7.292"},{"id":"24","razryad":"16","koef":"7.697"},{"id":"25","razryad":"17","koef":"8.106"},{"id":"26","razryad":"18","koef":"8.522"},{"id":"27","razryad":"19","koef":"8.943"},{"id":"28","razryad":"20","koef":"9.371"},{"id":"29","razryad":"21","koef":"9.804"},{"id":"30","razryad":"22","koef":"10.24"}]}');

print_r($result);

if (strcmp($text, "/minimalka") === 0) {
    $natija = "Hozirgi kunda eng kam oylik ish haqi - " . $result['zarplata'] . " so'm";
}
elseif ($tg->startsWith($text, "/maosh")) {
    $string = "Maosh hisoblash uchun quyidagi ko'rinishda kiriting (1-21): \nMasalan: \n /maosh 7";
    if ($text == "/maosh") $natija = $string;
    else {
        $r = substr_replace($text, '', 0, 6);
        $number = (int)$r;
        if ($number >= 0 && $number <= 22) {
            $arr = (array) $result['razryad'][$number];
            $natija = "Razryad - ".$arr['razryad']."\n Koeffitsient tarif - ".$arr['koef']."\n Sizning maoshingiz: ".($result['zarplata']*$arr['koef'])." so'm";
        } else $natija = "Siz noto'g'ri razryad kiritdingiz:\n\n";
    }
}
echo "<br><br><br>".$natija;
$tg->sendMessage($chat_id, $natija);


























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