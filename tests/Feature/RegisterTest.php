<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
		public function testRequireEmailPassword()
		{

			$response = $this->json('POST','api/v1/register');

			$response->assertStatus(422);

		}

		public function testSuccessfullyRegisterUser()
		{
			$payload = [
				'name' => 'john doe',
				'email' => 'johndoe@gmail.com',
				'password' => 'secret123',
			];

			$response = $this->json('POST', 'api/v1/register', $payload);

			$response->assertStatus(200)
								->assertJsonStructure([
									'access_token' ,
									'token_type'  ,
									'expires_in' ,
								]);
		}
}
