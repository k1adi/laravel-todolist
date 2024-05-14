<?php

namespace App\Services;

// Membuat kontrak user service untuk business logic
interface TodolistService
{
    public function saveTodo(string $id, string $todo): void;

    public function getTodo(): array;
}