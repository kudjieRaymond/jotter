<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LogoutTest extends TestCase
{
		public function testUserIsLoggedOutProperly()
		{
			$user = factory(User::class)->create(['email' => 'user@test.com']);

			$token = auth()->login($user);

			$headers = ['Authorization' => "Bearer $token"];

			$response = $this->json("POST", 'api/v1/logout' , [], $headers);

			$response->assertStatus(200)
								->assertJson([
									"message" =>'User logged out Successfully'
									]);
		}

}
