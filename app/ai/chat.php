<?php

namespace App\ai;

// use Illuminate\Support\Facades\Http;

use OpenAI\Laravel\Facades\OpenAI;

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

        $response =  OpenAI::chat()->create([
            "model" => "gpt-4o-mini",
            "messages" => $this->messages

        ])->choices[0]->message->content;

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
