<?php

declare(strict_types=1);


use Database\MyPdo;
use Entity\Collection\ArtistCollection;
use Html\AppWebPage;
use Html\WebPage;

$head=<<<HTML
    <meta charset="utf-8">
    <title> Musique</title>
HTML;


$body =<<<HTML
        <header>
            <h1> Hello Music </h1>
        </header>
        <content>
        <div>
HTML;

$artiste = (new Entity\Collection\ArtistCollection())->findAll();

$page = new AppWebPage();

foreach($artiste as $ligne) {
    $motTrans = $page->escapeString($ligne->getName());
    $body .= <<<HTML
        <p><a href='artist.php/?artistId={$ligne->getId()}' > $motTrans </a>\n";
    HTML;
}
    $body .= <<<HTML
            </div>
        </content> 
        <footer>
           <p>Modification</p>
        </footer>
HTML;

    $page->appendToHead($head);
    $page->appendContent($body);
    echo $page->toHTML();