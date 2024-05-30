<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'Rizki Adi',
            'todolist' => [
                ['id' => '1', 'name' => 'todo 1'],
                ['id' => '2', 'name' => 'todo 2']
            ]
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('todo 1')
            ->assertSeeText('2')
            ->assertSeeText('todo 2');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            'user' => 'Rizki Adi'
        ])->post('/todolist', [])
        ->assertSeeText('Todo is required');
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            'user' => 'Rizki Adi'
        ])->post('/todolist', [
            'todo' => 'Todo 1'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodo()
    {
        $this->withSession([
            'user' => 'Rizki Adi',
            'todolist' => [
                ['id' => '1', 'name' => 'todo 1'],
                ['id' => '2', 'name' => 'todo 2']
            ]
        ])->post('/todolist/1/delete')
        ->assertRedirect('/todolist');
    }
}
