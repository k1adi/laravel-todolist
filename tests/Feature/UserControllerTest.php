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

    public function testLoginMember() {
        $this->withSession([
            'user' => 'rizki'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginSuccess() {
        $this->post('/login', [
            'user' => 'rizki',
            'password' => 'asd123'
        ])->assertRedirect('/')
        ->assertSessionHas('user', 'rizki');
    }

    public function testLoginUserAuthenticated() {
        $this->withSession([
            'user' => 'rizki'
        ])->post('/login', [
            'user' => 'rizki',
            'password' => 'asd123'
        ])->assertRedirect('/');
    }

    public function testLogoutGuest() {
        $this->post('/logout')
            ->assertRedirect('/login');
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
