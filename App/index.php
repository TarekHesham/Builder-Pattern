<?php

require_once __DIR__ . '/autoload.php';

use App\Builders\EmbedBuilder;
use App\Services\EmbedService;
use DTOs\EmbedField;

// Set embed URL
// EmbedService::setEmbedURL("https://discord.com/api/webhooks/channel_id/hook_token");

// First test
$lolProfileEmbed = new EmbedBuilder()
    ->setColor("#108b45")
    ->setTitle("Summoner Profile")
    ->setURL("https://www.leagueoflegends.com")
    ->setAuthor(
        "League of Legends",
        "https://www.rw-designer.com/icon-image/21516-256x256x32.png",
        "https://www.leagueoflegends.com"
    )
    ->setDescription("**Summoner Overview**\nCheck out the ranked stats and recent performance.")
    ->setThumbnail("https://wiki.leagueoflegends.com/en-us/images/thumb/Summoner_Icons.png/400px-Summoner_Icons.png")
    ->addFields(
        new EmbedField("Summoner Name", "Faker", true),
        new EmbedField("Region", "KR", true),
        new EmbedField("Rank", "Challenger", true),
        new EmbedField("LP", "1250 LP", true),
        new EmbedField("Main Role", "Mid Lane", true),
    )
    ->setImage("https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ahri_0.jpg")
    ->setTimestamp()
    ->setFooter(
        "Data provided by Riot Games",
        "https://www.rw-designer.com/icon-image/21516-256x256x32.png"
    );

EmbedService::send($lolProfileEmbed);

// Secound test
$lolMatchEmbed = new EmbedBuilder()
    ->setColor(0x00FF7F)
    ->setTitle("Ranked Match Result")
    ->setURL("https://www.op.gg")
    ->setAuthor(
        "Match History",
        "https://www.rw-designer.com/icon-image/21516-256x256x32.png",
        "https://www.op.gg"
    )
    ->setDescription("**Victory!**\nAmazing performance in ranked solo queue.")
    ->setThumbnail("https://ddragon.leagueoflegends.com/cdn/13.1.1/img/champion/Yasuo.png")
    ->addFields(
        [
            "name" => "Champion",
            "value" => "Yasuo",
            "inline" => true
        ],
        [
            "name" => "K / D / A",
            "value" => "12 / 3 / 9",
            "inline" => true
        ],
        [
            "name" => "CS",
            "value" => "245",
            "inline" => true
        ],
        [
            "name" => "Game Duration",
            "value" => "32:18",
            "inline" => true
        ],
        [
            "name" => "Rank Change",
            "value" => "+24 LP",
            "inline" => true
        ],
    )
    ->setImage("https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Yasuo_0.jpg")
    ->setTimestamp()
    ->setFooter(
        "Ranked Solo/Duo • Season 2026",
        "https://www.rw-designer.com/icon-image/21516-256x256x32.png"
    );

EmbedService::send([$lolProfileEmbed, $lolMatchEmbed]);

// Third test
EmbedService::send($lolMatchEmbed, "League of Legends", "https://www.rw-designer.com/icon-image/21516-256x256x32.png");
