<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Artist;
use PDO;

class ArtistCollection
{

    /**
     * Fonction qui permet de mettre dans un tableau tous les artistes de la base de données
     * @return Artist[]
     */
    public function findAll(): array
    {
        $sql = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id , name 
            FROM artist
            ORDER BY name
            SQL
        );
        $sql -> execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, Artist::class);
    }
}
