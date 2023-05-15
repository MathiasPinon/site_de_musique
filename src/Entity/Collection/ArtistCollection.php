<?php
declare(strict_types=1)
namespace Entity\Collection;

class ArtistCollection
{
    /**
     * Fonction qui permet de mettre dans un tableau tous les artistes de la base de données
     * @return Artist[]
     */
    public function findAll() : array {
        $sql = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT name
            FROM artist
            ORDER BY name
            SQL
        );
        $resultat = $sql -> execute();
        $tab = array();
        while($resultat->fetchAll(PDO::FETCH_CLASS, Artist::Class) !== False ){
            $tab[] = $resultat->name;
        }
        return $tab ;
    }
}