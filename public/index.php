<?php

declare(strict_types=1);


use Database\MyPdo;
use Entity\Collection\ArtistCollection;
use Html\AppWebPage;
use Html\WebPage;

$head=<<<HTML
    <meta charset="utf-8">
    <title>Artistes</title>
HTML;


$body =<<<HTML
        <div class="header">
            <h1> Artistes </h1>
        </div>
        <div class="content">
            <div class="list">
HTML;

$artiste = (new Entity\Collection\ArtistCollection())->findAll();

$page = new AppWebPage();

foreach($artiste as $ligne) {
    $motTrans = $page->escapeString($ligne->getName());
    $body .= <<<HTML
        <p><a href='artist.php?artistId={$ligne->getId()}' >$motTrans</a>\n";
    HTML;
}
    $body .= <<<HTML
            </div>
        </div> 
        <div class="footer">
           <p>Modification</p>
        </div>
HTML;

    $page->appendToHead($head);
    $page->appendContent($body);
    echo $page->toHTML();