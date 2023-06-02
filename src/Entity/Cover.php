<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {

        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT id , jpeg
            FROM cover
            WHERE id = :Id 
SQL
        );
        $sql->execute([':Id' => $id]);
        $sql ->setFetchMode(PDO::FETCH_CLASS, Cover::class);
        $resultat = $sql -> fetch();
        if($resultat!==false) {
            return $resultat;
        }
        throw new EntityNotFoundException('erreur');
    }
}
