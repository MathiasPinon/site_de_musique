<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;




MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');


$head=<<<HTML
    <meta charset="utf-8">
    <title> Musique</title>
HTML;

$style = <<<HTML
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

HTML;
$body =<<<HTML
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

$page = new WebPage();

while (($ligne = $stmt->fetch()) !== false) {
    $motTrans =  $page->escapeString($ligne['name']);
    $body .= "<p>$motTrans\n";
}

$body.=<<<HTML
        </div>

HTML;

$page ->appendToHead($head);
$page ->appendCss($style);
$page -> appendContent($body);
echo($page->toHTML());
