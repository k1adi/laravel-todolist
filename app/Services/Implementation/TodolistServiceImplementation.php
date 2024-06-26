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
            'name' => $todo
        ]);
   }

   public function getTodo(): array {
        return Session::get('todolist', []);
   }

   public function removeTodo(string $todoId){
        $todolist = Session::get('todolist');

        foreach($todolist as $index => $value) {
            if($value['id'] == $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put('todolist', $todolist);
   }
}