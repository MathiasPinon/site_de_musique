<?php
declare(strict_types=1);
namespace Entity\Collection;
use Database\MyPdo;
use Entity\Album;
use Entity\Artist;
use PDO;

class AlbumCollection
{
    public static function findByArtistId(int $artistId):array{
        $sql = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id , name , year , artistId , genreId , coverId
            FROM album 
            WHERE artistId = :idArtist
            ORDER BY year DESC, name ;
            SQL
        );

        $sql -> execute([':idArtist'=>$artistId]);
        return $sql->fetchAll(PDO::FETCH_CLASS, Album::class);
}
}