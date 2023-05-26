<?php

use Database\MyPdo;

if (isset($_GET['artistId']) &&
    (!empty($_GET['artistId'])) &&
        ctype_digit($_GET['artistId'])) {
    $sql = MyPDO::getInstance()->prepare(
        <<<'SQL'
                SELECT name
                FROM artist
                where id = :idArtiste
SQL
    );
    $sql->execute(['idArtiste' => $_GET['artistId']]);
    $resultatReq = $sql->fetchAll(PDO::FETCH_NUM);

    $sql1 = MyPDO::getInstance()->prepare(
        <<<SQL
                        SELECT year , name 
                        FROM album
                        WHERE artistId = :idArtiste
                        ORDER BY 1 DESC ,2
                    SQL
    );

    $sql1->execute(['idArtiste' => $_GET['artistId']]);
    $resultat = $sql1->fetchAll(PDO::FETCH_NUM);

    if(count($resultatReq)===0) {
        exit(404);
    }
    $html = <<<HTML
                        <!DOCTYPE HTML>
                        <html>
                            <head>
                                <meta charset="UTF-8">
                                <title>Album de {$resultatReq[0][0]} </title>
                                <style>
                                    html{
                                        width:100%;
                                        height: 100%;
                                    }
                                    body{
                                        width:80%;
                                        height:100%;
                                        margin:auto;
                                        overflow-x:hidden;
                                        display:flex;
                                        flex-direction: column ;
                                    }
                                    header{
                                        margin-top:10px;
                                        border:10px black solid;
                                        margin-bottom: 5px;
                                        padding:5px;
                                    }
                                    content{
                                        border:10px black solid;
                                        margin-bottom: 5px;
                                        padding:10px;
                                        height: 50% ;
                                        flex-grow:2;
                                        display:flex;
                                    }
                                    footer{
                                        border:10px black solid;
                                        padding:5px;
                                    }
                                    .liste{
                                        overflow:auto;
                                        padding : 10px ;
                                        border: 10px dashed #5b5b5b ;
                                        width : 100% ;
                                    }
                                    .album{
                                    display: flex;
                                    width: 100%;
                                    border : black 2px solid;
                                    flex-direction: row;
                                    margin-bottom: 3px; 
                                    }
                                    .date{
                                        margin-right: 5px;
                                        margin-left: 5px;
                                        border: solid 1px black;
                                        align-items: center;
                                    }
                                    .albums{
                                        border: solid 1px black;
                                        align-items: center;
                                    }
                                    h1{
                                        text-align:center;
                                        border-style: dashed;
                                        padding:5px;
                                        text-decoration-color: red;
                                    }
                                </style>
                            </head>
                            <body>
                                <h1> Album {$resultatReq[0][0]} </h1>
                                <content>
                                <div class="liste">
                    HTML;

    foreach ($resultat as $ligne) {

        $html .=<<<HTML
        <div class="album">
             <p class="date"> {$ligne[0]}</p>
             <p class="albums"> {$ligne[1]}</p>
        </div>
    HTML;
    }

    $html .= <<<HTML
                                </div>
                            </content>
                            <footer> <p> Derniere modification </p></footer>
                        </body>
                        </html>
                    HTML;

    echo($html);
} else {
    header("Location: index.php");
    exit(302);
}
