<?php

declare(strict_types=1);

namespace Art;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\ORM\Entity\Behavior;

#[Entity(
    table: 'cfa'
)]
#[Behavior\CreatedAt(
    field: 'createdAt',   // Required. By default 'createdAt'
    column: 'created_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
#[Behavior\UpdatedAt(
    field: 'updatedAt',   // Required. By default 'updatedAt' 
    column: 'updated_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
class CFA
{
    #[Column(type: 'primary', name: 'record_id')]
    private int $id;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;
    
    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Column(type: 'integer', name: 'piece_id')]
    private string $piece_id;

    #[Column(type: 'integer', name: 'piece_id_run', nullable: true)]
    private string $piece_id_run;

    #[Column(type: 'integer', name: 'piece_id_count', nullable: true)]
    private string $piece_id_count;

    #[Column(type: 'string(255)', name: 'print_company', nullable: true)]
    private string $print_company;

    #[Column(type: 'string(255)', name: 'print_date_sent', nullable: true)]
    private string $print_date_sent;

    #[Column(type: 'string(255)', name: 'print_date_receipt', nullable: true)]
    private string $print_date_receipt;

    #[Column(type: 'string(255)', name: 'print_medium', nullable: true)]
    private string $print_medium;
    
    #[Column(type: 'string(255)', name: 'print_cost', nullable: true)]
    private string $print_cost;

    #[Column(type: 'string(255)', name: 'print_notes', nullable: true)]
    private string $print_notes;

    #[Column(type: 'string(255)', name: 'buyer_name', nullable: true)]
    private string $buyer_name;

    #[Column(type: 'string(255)', name: 'buyer_location', nullable: true)]
    private string $buyer_location;

    #[Column(type: 'string(255)', name: 'buyer_date_purchase', nullable: true)]
    private string $buyer_date_purchase;

    #[Column(type: 'string(255)', name: 'buyer_date_receipt', nullable: true)]
    private string $buyer_date_receipt;

    #[Column(type: 'text', name: 'notes', nullable: true)]
    private string $notes;
}

?>