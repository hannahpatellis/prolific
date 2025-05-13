<?php

declare(strict_types=1);

namespace Art;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\ORM\Entity\Behavior;

#[Entity(
    table: 'pieces'
)]
#[Behavior\CreatedAt(
    field: 'createdAt',   // Required. By default 'createdAt'
    column: 'created_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
#[Behavior\UpdatedAt(
    field: 'updatedAt',   // Required. By default 'updatedAt' 
    column: 'updated_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
class Pieces
{
    #[Column(type: 'primary', name: 'id')]
    private int $id;

    #[Column(type: 'string(300)', name: 'title')]
    private string $title;

    #[Column(type: 'string(10)', name: 'start_date')]
    private string $start_date;

    #[Column(type: 'string(10)', name: 'end_date')]
    private string $end_date;

    #[Column(type: 'string(300)', name: 'collection')]
    private string $collection;

    #[Column(type: 'string(300)', name: 'subcollection')]
    private string $subcollection;

    #[Column(type: 'string(7)', name: 'size_height')]
    private string $size_height;

    #[Column(type: 'string(7)', name: 'size_width')]
    private string $size_width;

    #[Column(type: 'string(2)', name: 'size_unit')]
    private string $size_unit;

    #[Column(type: 'string(300)', name: 'temperature')]
    private string $temperature;

    #[Column(type: 'string(300)', name: 'background')]
    private string $background;

    #[Column(type: 'string(300)', name: 'colors')]
    private string $colors;

    #[Column(type: 'text', name: 'description')]
    private string $description;

    #[Column(type: 'text', name: 'story')]
    private string $story;

    #[Column(type: 'text', name: 'notes')]
    private string $notes;

    #[Column(type: 'string(300)', name: 'location')]
    private string $location;

    #[Column(type: 'string(300)', name: 'thumbnail')]
    private string $thumbnail;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;
    
    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
}

?>