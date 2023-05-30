<?php
declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    public function __construct(string $title = '')
    {
        parent::__construct($title);
        parent::appendCssUrl('/css/style.css');
    }

    public function toHTML(): string
    {
        return parent::toHTML(); // TODO: Change the autogenerated stub
    }
}