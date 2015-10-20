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
        $url = $this->website.
            '/sendMessage?' .
            http_build_query(
                array(
                    "chat_id" => $chat_id,
                    "text" => urlencode($text)
                )
            );
        file_get_contents($url);
    }

}

