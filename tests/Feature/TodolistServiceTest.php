<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

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
            self::assertEquals('Todo 1', $todo['name']);
        }
    }

    public function testGetTodolistEmpty() {
        self::assertEquals([], $this->todolistService->getTodo());
    }

    public function testGetTodolistNotEmpty() {
        $expected = [
            ['id' => '1', 'name' => 'Todo 1'],
            ['id' => '2', 'name' => 'Todo 2'],
        ];

        $this->todolistService->saveTodo('1', 'Todo 1');
        $this->todolistService->saveTodo('2', 'Todo 2');

        self::assertEquals($expected, Session::get('todolist'));
    }

    public function testRemoveTodolist() {
        $this->todolistService->saveTodo('1', 'todo 1');
        $this->todolistService->saveTodo('2', 'todo 2');
        self::assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->removeTodo('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodo()));
        
        $this->todolistService->removeTodo('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodo()));
        
        $this->todolistService->removeTodo('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodo()));
    }
}
