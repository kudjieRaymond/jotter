<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
	use RefreshDatabase;
	/**
	 * 
	 * @test
	 */
	public function login_requires_validation()
	{
		$response = $this->json('POST', 'api/v1/login', []);

		$response->assertStatus(422);
		
	}
	
	public function testUserLoginSuccessfully()
	{
		$user = factory(User::class)->create([
													'email'=>'testlogin@gmail.com',
													'password'=>bcrypt('123456')
													]);
		$payload = ['email'=>'testlogin@gmail.com', 'password'=>'123456'];

		$response = $this->json('POST', 'api/v1/login', $payload);
		
		$response->assertStatus(200)
							->assertJsonStructure([
								'access_token' ,
								'token_type'  ,
								'expires_in' ,
								'user'
							]);
	}
}
