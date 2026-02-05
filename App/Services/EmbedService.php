<?php

namespace App\Services;

use App\Builders\EmbedBuilder;

class EmbedService
{
    private static $embedURL = null;

    public static function setEmbedURL(string $embedURL): void {
        self::$embedURL = $embedURL;
    }

    public static function send(EmbedBuilder|array $embeds, ?string $username = null, ?string $avatarURL = null) {
        if (! isset(self::$embedURL)) {
            throw new \Exception("Embed URL is not set");
        }

        $data["embeds"] = is_array($embeds) ? array_map(fn($e) =>$e->build(), $embeds) : [$embeds->build()];

        if ($username) $data["username"] = $username;
        if ($avatarURL) $data["avatar_url"] = $avatarURL;

        $curl = curl_init(self::$embedURL);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_exec($curl);
    }
}
