<?php

use Database\MyPdo;
use Entity\Artist;

if (isset($_GET['artistId']) &&
    (!empty($_GET['artistId'])) &&
        ctype_digit($_GET['artistId'])) {
    try {
            $artiste = Artist::findById((int)$_GET['artistId']);
    }

    catch(\Entity\Exception\EntityNotFoundException){
        http_response_code(404);
        exit();
    }
    $albums = \Entity\Collection\AlbumCollection::findByArtistId($artiste->getId());
   $page = new  \Html\WebPage("Albums de {$artiste->getName()}");
   $page->appendCssUrl("css/style.css");
    $page->appendContent(<<<HTML
                                <div class="header">
                                    <h1>Albums de {$artiste->getName()}</h1>
                                </div>
                                <div class="content">
                                <div class="list">
                    HTML);

    foreach ($albums as $album) {
        $nom = $page->escapeString($album->getName());
        $page->appendContent(<<<HTML
        <div class="album">
             <div class="album__year">{$album->getYear()}</div>
             <div class="album__name">{$nom}</div>
        </div>
    HTML);
    }

    $page->appendContent( <<<HTML
                                </div>
                                </div>
                            </content>
                            <div class="footer"> <p>Derniere modification</p></div>
                        </body>
                        </html>
                    HTML);

    echo($page->toHTML());
} else {
    header("Location: index.php");
    exit(302);
}
