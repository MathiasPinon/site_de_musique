<?php

declare(strict_types=1);

namespace Entity;

class Artist
{
    private string $id;
    private string $name;

    /**
     * @return string
     */
    public function getId(): string
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

}