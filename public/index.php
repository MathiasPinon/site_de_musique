<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;

MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

$html = <<<HTML
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title> Musique</title>
        <style>
            html,body{
                width:100%;
                height: 100%;
            }
            p{
                border: 5px solid black;
                background-color: ghostwhite;
                text-decoration-color: black;
                width : 4cm ; 
                padding-top: 30px;
                padding-bottom:30px;
                margin: 0.5cm ;
                text-align: center;
                box-sizing: border-box;  
            }
            div{
                overflow:auto;
                padding : 10px ;
                border: 10px dashed #5b5b5b ;
                box-sizing: border-box;
                width : 7cm ; 
                height: 10cm ;
            }
            h1{
                text-decoration-color: red;
            }
        </style>
        
    </head>
    <body>
        <h1> Hello Music </h1>
        <div>

HTML;

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $html .= "<p>{$ligne['name']}\n";
}

$html .=<<<HTML
        </div>
    </body>
</html>
HTML;

echo $html;
