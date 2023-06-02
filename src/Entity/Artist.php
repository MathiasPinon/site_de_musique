<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Artist
{
    private int  $id ;
    private string $name;

    /**
     * @return string
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(int $id): Artist
    {
        $sql = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id , name 
                FROM artist
                WHERE id = :ID ;
SQL
        );
        $sql -> setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $sql -> execute([':ID' => $id]);
        $res = $sql ->fetch();
        if($res===false) {
            throw new EntityNotFoundException();
        }
        return $res;
    }

    public function getAlbums()
    {
        $sql = MyPDO::getInstance()->prepare(
            <<<SQL
                SELECT id , name , year , artistId , genreId , coverId
                FROM album
                WHERE id = :ID ;
SQL
        );
        $sql->execute([':ID' => $this->id]);
        $sql -> fetchAll(PDO::FETCH_CLASS, Album::class);
    }

}
