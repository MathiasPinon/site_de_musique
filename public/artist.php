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
                                    html,body {
                                    height:100%;
                                    width: 100%;
                                    }
                                    h1{
                                    border-style: solid;
                                    border-color: #00001a;
                                    width:60%;
                                    margin:auto ;
                                    text-align: center;
                                    color: #679cb9;
                                    }
                                    p{
                                    border: 5px solid black;
                                    background-color: ghostwhite;
                                    text-decoration-color: black;
                                    width : auto ; 
                                    height: 40px;
                                    pading:30px
                                    margin: 0.5cm ;
                                    text-align: center;
                                    box-sizing: border-box;  
                                    }   
                                    
                                    div{
                                    background-color: #111111;
                                    margin-top:2cm;
                                    margin-left:35%;
                                    margin-right:35%;
                                    align-content: center;
                                    overflow:auto;
                                    padding : 10px ;
                                    border: 10px dashed #ececec ;
                                    box-sizing: border-box;
                                    width : auto; 
                                    height: 10cm ;
                                     }
                            
                                </style>
                            </head>
                            <body>
                                <h1> Album {$resultatReq[0][0]} </h1>
                                <div>
                    HTML;

    foreach ($resultat as $ligne) {
        $html .= "<p> {$ligne[0]} {$ligne[1]} </p>";
    }

    $html .= <<<HTML
                            </div>
                        </body>
                        </html>
                    HTML;

    echo($html);
} else {
    header("Location: index.php");
    exit(302);
}
