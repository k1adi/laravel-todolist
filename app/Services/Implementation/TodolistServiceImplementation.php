<?php

namespace App\Services\Implementation;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// Implementasi business logic dari user service interface
class TodolistServiceImplementation implements TodolistService
{
   public function saveTodo(string $id, string $todo): void {
        if(!Session::exists('todolist')) {
            Session::put('todolist', []);
        }

        Session::push('todolist', [
            'id' => $id,
            'todo' => $todo
        ]);
   }

   public function getTodo(): array {
        return Session::get('todolist', []);
   }
}