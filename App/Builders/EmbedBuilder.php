<?php

namespace App\Builders;

use App\Contracts\EmbedBuilderInterface;
use DTOs\EmbedField;

/**
 * This class is used to build an embed object for Discord.
 * 
 * @method EmbedBuilder setColor(int $color)
 * @method EmbedBuilder setTitle(string $title)
 * @method EmbedBuilder setURL(string $url)
 * @method EmbedBuilder setAuthor(string $name, string $iconURL, string $url)
 * @method EmbedBuilder setDescription(string $description)
 * @method EmbedBuilder setThumbnail(string $url)
 * @method EmbedBuilder addField(string $name, string $value, bool $inline = false)
 * @method EmbedBuilder addFields(EmbedField|array ...$fields)
 * @method EmbedBuilder setImage(string $url)
 * @method EmbedBuilder setTimestamp()
 * @method EmbedBuilder setFooter(string $text, string $iconURL)
 */
class EmbedBuilder implements EmbedBuilderInterface
{
    private $embed;

    public function __construct()
    {
        $this->reset();
    }

    private function reset(): void
    {
        $this->embed = new \stdClass();
        $this->embed->fields = [];
    }

    public function setColor(int|string $color): EmbedBuilderInterface
    {
        if (is_string($color)) {
            $color = hexdec(str_replace('#', '', $color));
        }
        $this->embed->color = $color;
        return $this;
    }

    public function setTitle(string $title): EmbedBuilderInterface
    {
        $this->embed->title = $title;
        return $this;
    }

    public function setURL(string $url): EmbedBuilderInterface
    {
        $this->embed->url = $url;
        return $this;
    }

    public function setAuthor(string $name, string $iconURL, string $url): EmbedBuilderInterface
    {
        $this->embed->author = [
            'name' => $name,
            'icon_url' => $iconURL,
            'url' => $url
        ];

        return $this;
    }

    public function setDescription(string $description): EmbedBuilderInterface
    {
        $this->embed->description = $description;
        return $this;
    }

    public function setThumbnail(string $url): EmbedBuilderInterface
    {
        $this->embed->thumbnail = compact('url');
        return $this;
    }

    public function addField(string $name, string $value, bool $inline = false): EmbedBuilderInterface
    {
        if (count($this->embed->fields) >= 25) {
            throw new \Exception("Max count of fields is 25 !");
        }

        $this->embed->fields[] = compact('name', 'value', 'inline');
        return $this;
    }

    public function addFields(EmbedField|array ...$fields): EmbedBuilderInterface
    {
        foreach($fields as $field) {
            if (! $field instanceof EmbedField) {
                $field = EmbedField::fromArray($field);
            }

            $this->addField($field->name, $field->value, $field->inline);
        }
        
        return $this;
    }

    public function setImage(string $url): EmbedBuilderInterface
    {
        $this->embed->image = compact('url');
        return $this;
    }

    public function setTimestamp(): EmbedBuilderInterface
    {
        $this->embed->timestamp = new \DateTime()->format('c');
        return $this;
    }

    public function setFooter(string $text, string $iconURL): EmbedBuilderInterface
    {
        $this->embed->footer = ['text' => $text, 'icon_url' => $iconURL];
        return $this;
    }

    public function build(): object
    {
        return $this->embed;
    }
}
