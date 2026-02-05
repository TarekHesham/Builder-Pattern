<?php

namespace App\Contracts;

use DTOs\EmbedField;

interface EmbedBuilderInterface
{
    public function setColor(int|string $color): EmbedBuilderInterface;
    public function setTitle(string $title): EmbedBuilderInterface;
    public function setURL(string $url): EmbedBuilderInterface;
    public function setAuthor(string $name, string $iconURL, string $url): EmbedBuilderInterface;
    public function setDescription(string $description): EmbedBuilderInterface;
    public function setThumbnail(string $url): EmbedBuilderInterface;
    public function addField(string $name, string $value, bool $inline = false): EmbedBuilderInterface;
    public function addFields(EmbedField|array ...$fields): EmbedBuilderInterface;
    public function setImage(string $url): EmbedBuilderInterface;
    public function setTimestamp(): EmbedBuilderInterface;
    public function setFooter(string $text, string $iconURL): EmbedBuilderInterface;
    public function build(): object;
}