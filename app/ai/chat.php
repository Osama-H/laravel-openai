<?php

namespace App\ai;

use Illuminate\Support\Facades\Http;

class Chat
{
    protected array $messages = [];


    public function systemMessage(string $message)
    {
        $this->messages[] = [
            "role" => "system",
            "content" => $message
        ];

        return $this;
    }
    public function send(string $message)
    {
        $this->messages[] = [
            "role" => "user",
            "content" => $message
        ];

        $response =  Http::withToken(config('services.openai.api_key'))->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-4o-mini",
            "messages" => $this->messages

        ])->json('choices.0.message.content');

        if ($response) {
            $this->messages[] = [
                "role" => "assistant",
                'content' => $response
            ];
        }

        return $response;
    }

    public function reply(string $message)
    {
        return $this->send($message);
    }

    public function messages()
    {
        return $this->messages;
    }
}
