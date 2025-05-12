<?php

declare(strict_types=1);

namespace Art;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\ORM\Entity\Behavior;

#[Entity(
    table: 'users'
)]
#[Behavior\CreatedAt(
    field: 'createdAt',   // Required. By default 'createdAt'
    column: 'created_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
#[Behavior\UpdatedAt(
    field: 'updatedAt',   // Required. By default 'updatedAt' 
    column: 'updated_at'  // Optional. By default 'null'. If not set, will be used information from property declaration.
)]
class Users
{
    #[Column(type: 'primary', name: 'id')]
    private int $id;

    #[Column(type: 'string(100)', name: 'username', nullable: true)]
    private string $username;

    #[Column(type: 'string(100)', name: 'password_hash', nullable: true)]
    private string $password_hash;

    #[Column(type: 'string(60)', name: 'first_name', nullable: true)]
    private string $first_name;

    #[Column(type: 'string(120)', name: 'last_name', nullable: true)]
    private string $last_name;

    #[Column(type: 'string(256)', name: 'email')]
    private string $email;

    #[Column(type: 'boolean', name: 'isAdmin', default: 0)]
    private string $isAdmin;

    #[Column(type: 'boolean', name: 'selectionOnly', default: 1)]
    private string $selectionOnly;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;
    
    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
}

?>