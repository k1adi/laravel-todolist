<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void {
        parent::setUp();

        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull() {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo() {
        $this->todolistService->saveTodo('1', 'Todo 1');

        $todolist = Session::get('todolist');
        foreach($todolist as $todo) {
            self::assertEquals('1', $todo['id']);
            self::assertEquals('Todo 1', $todo['todo']);
        }
    }

    public function testGetTodolistEmpty() {
        self::assertEquals([], $this->todolistService->getTodo());
    }

    public function testGetTodolistNotEmpty() {
        $expected = [
            ['id' => '1', 'todo' => 'Todo 1'],
            ['id' => '2', 'todo' => 'Todo 2'],
        ];

        $this->todolistService->saveTodo('1', 'Todo 1');
        $this->todolistService->saveTodo('2', 'Todo 2');

        self::assertEquals($expected, Session::get('todolist'));
    }
}
