<?php

class TelegramAPI
{

    const TOKEN = "148278479:AAFPMVrxoSPQG3xC1FUFvQL3nNgDOvZ1h-8";
    const BASE_URL = 'https://api.telegram.org/bot';
    private $baseURL;

    function __construct()
    {
        $this->baseURL = self::BASE_URL . self::TOKEN . '/';
    }

//    public function sendMessage($chat_id, $text)
//    {
//        $url = $this->website . '/sendMessage?' . http_build_query(
//                array(
//                    "chat_id" => $chat_id,
//                    "text" => urlencode($text)
//                ));
//        file_get_contents($url);
//    }

//    public function sendMessageReplyMarkup($chat_id,$text,$disable_web_page_preview = false,$reply_to_message_id = null,$reply_markup = null)
//    {
//        $url = $this->website . "/sendMessage?" . http_build_query(
//                array(
//                    "chat_id" => $chat_id,
//                    "text" => $text,
//                    "disable_web_page_preview" => $disable_web_page_preview,
//                    "reply_to_message_id" => $reply_to_message_id,
//                    "reply_markup" => $reply_markup
//                )
//            );
//        file_get_contents($url);
//    }

    public function sendMessage(
        $chat_id,
        $text,
        $disable_web_page_preview = false,
        $reply_to_message_id = null,
        $reply_markup = null
    ) {
        $params = compact('chat_id', 'text', 'disable_web_page_preview', 'reply_to_message_id', 'reply_markup');
        return $this->sendRequest('sendMessage', $params);
    }

    public function forwardMessage($chat_id, $from_chat_id, $from_chat_id)
    {
        $params = compact('chat_id', 'from_chat_id', 'from_chat_id');

        return $this->sendRequest('forwardMessage', $params);
    }

    public function sendPhoto($chat_id, $photo, $caption = null, $reply_to_message_id = null, $reply_markup = null)
    {
        $data = compact('chat_id', 'photo', 'caption', 'reply_to_message_id', 'reply_markup');

        if (((!is_dir($photo)) && (filter_var($photo, FILTER_VALIDATE_URL) === FALSE)))
            return $this->sendRequest('sendPhoto', $data);

        return $this->uploadFile('sendPhoto', $data);
    }

    public function sendChatAction($chat_id, $action)
    {
        $params = compact('chat_id', 'action');
        return $this->sendRequest('sendChatAction', $params);
    }

    private function sendRequest($method, $params)
    {
        return json_decode(file_get_contents($this->baseURL . $method . '?' . http_build_query($params)), true);
    }

    public function getWebhookUpdates()
    {
        $body = json_decode(file_get_contents('php://input'), true);

        return $body;
    }


    public function replyKeyboardMarkup(
        $keyboard,
        $resize_keyboard = false,
        $one_time_keyboard = false,
        $selective = false
    ) {
        return json_encode(compact('keyboard', 'resize_keyboard', 'one_time_keyboard', 'selective'));
    }

    public static function replyKeyboardHide($selective = false)
    {
        $hide_keyboard = true;

        return json_encode(compact('hide_keyboard', 'selective'));
    }

    public static function forceReply($selective = false)
    {
        $force_reply = true;

        return json_encode(compact('force_reply', 'selective'));
    }


    public function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
    public function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
}

