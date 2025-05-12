<?php

declare(strict_types=1);

namespace Art;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\ORM\Entity\Behavior;

#[Entity(
    table: 'registry'
)]
#[Behavior\CreatedAt(
    field: 'createdAt',   // Required. By default 'createdAt'
    column: 'created_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
#[Behavior\UpdatedAt(
    field: 'updatedAt',   // Required. By default 'updatedAt' 
    column: 'updated_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
class Registry
{
    #[Column(type: 'primary', name: 'id')]
    private int $id;

    #[Column(type: 'string(1000)', name: 'name')]
    private string $name;

    #[Column(type: 'string(1000)', name: 'value')]
    private string $value;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;
    
    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
}

?>