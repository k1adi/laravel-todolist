<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage() {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess() {
        $this->post('/login', [
            'user' => 'rizki',
            'password' => 'asd123'
        ])->assertRedirect('/')
        ->assertSessionHas('user', 'rizki');
    }

    public function testLoginFailed() {
        $this->post('/login', [
            'user' => 'rizki',
            'password' => 'salah'
        ])->assertSeeText('User or Password is incorrect!');
    }

    public function testLoginValidationError() {
        $this->post('/login', [])
            ->assertSeeText('User and Password is Required!');
    }

    public function testLogout() {
        $this->withSession([
            'user' => 'Rizki'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }
}
