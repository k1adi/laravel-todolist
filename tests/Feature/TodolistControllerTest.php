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
}
