<?php

class TelegramAPI
{

    private $token = "148278479:AAFPMVrxoSPQG3xC1FUFvQL3nNgDOvZ1h-8";
    private $website;
    private $update;

    public function getUpdatedArray()
    {
        return json_decode($this->update, TRUE);
    }

    function __construct()
    {
        $this->website = "https://api.telegram.org/bot" . $this->token;
        $this->update = file_get_contents("php://input");
    }

    public function sendMessage($chat_id, $text)
    {
        $url = $this->website . '/sendMessage?' . http_build_query(
                array(
                    "chat_id" => $chat_id,
                    "text" => urlencode($text)
                ));
        file_get_contents($url);
    }

    public function sendMessageReplyMarkup(
        $chat_id,
        $text,
        $disable_web_page_preview = false,
        $reply_to_message_id = null,
        $reply_markup = null
    )
    {
        $url = $this->website . "/sendMessage?" . http_build_query(
                array(
                    "chat_id" => $chat_id,
                    "text" => $text,
                    "disable_web_page_preview" => $disable_web_page_preview,
                    "reply_to_message_id" => $reply_to_message_id,
                    "reply_markup" => $reply_markup
                )
            );
        file_get_contents($url);
    }

    public function replyKeyboardMarkup(
        $keyboard,
        $resize_keyboard = false,
        $one_time_keyboard = false,
        $selective = false
    )
    {
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
}

