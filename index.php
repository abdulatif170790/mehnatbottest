<?php

include_once 'TelegramAPI.php';
ini_set('error_reporting', E_ALL);

$tg = new TelegramAPI();
$updateArray = $tg->getUpdatedArray();
$chatId = $updateArray['message']['chat']['id'];
$text = $updateArray['message']['text'];

switch ($text) {
    case 'Q':
        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];
        $reply_markup = $tg->replyKeyboardMarkup($keyboard, true, true);
        $tg->sendMessageReplyMarkup($chatId, $text, false, null, $reply_markup);
        break;
    case "W":
        $reply_markup = $tg->replyKeyboardHide();
        $tg->sendMessageReplyMarkup($chatId, $text, false, null, $reply_markup);
        break;
    case "E":
        $reply_markup = $tg->forceReply();
        $tg->sendMessageReplyMarkup($chatId, $text, false, null, $reply_markup);
        break;
    default:
        $tg->sendMessage($chatId, $chatId.$text);
        break;


}


?>