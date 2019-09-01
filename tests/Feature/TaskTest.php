<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Task;

class TaskTest extends TestCase
{
	use RefreshDatabase ;

	protected $user ;
	/**
	 * Create user and get token
	 * @return string
	 */
	protected function authenticate()
	{
		$this->user = factory(User::class)->create();
		$token = auth()->login($this->user);
		return $token;
	}

	public function testCreatePost()
	{
		$payload = [
			'title' => 'meeting',
			"description" =>'This is a very important meeting',
			'done' => 0 ,
		];
		
		$token = $this->authenticate();

		$response = $this->withHeaders(["Authorization" => "Bearer $token"])
										->json("POST", route('tasks.store'), $payload);

		$response->assertStatus(201);

		//Get count and assert
		$count = $this->user->tasks()->count();
		$this->assertEquals(1,$count);
	}

	public function testAllTasks()
	{
		$token = $this->authenticate();

		factory(Task::class , 3)->create(); //create three tasks;
		factory(Task::class)->create([
			"title" => 'order food',
			"description" => "Buy food from kfc",
			"user_id" =>$this->user->id,
		]);

		/*
		$task = Task::create([
			"title" => 'order food',
			"description" => "Buy food from kfc",
			"user_id" =>$this->user->id,
		]);
*/

		$headers = ["Authorization"=> "Bearer $token"];
		$response = $this->json("GET", route("tasks.index"), $headers);

		$response->assertStatus(200)
							->assertJsonStructure([
								'data'
							])	;
		//assert that order food is returned					
		$this->assertEquals('order food',$response->json()['data'][3]['title']);
	}

	public function testCanUpdateTask()
	{
		$token = $this->authenticate();

		$task = factory(Task::class)->create([
			"title" => 'this is a title',
			"description" => "this is a description",
			"user_id" =>$this->user->id,
		]);
		$payload =  [
			'title' => 'this is an updated title',
			'description' => "this is an updated description",
			"done" =>1
		];

		$headers = ['Authorization' =>"Bearer $token"];
		$response = $this->json("PUT", route("tasks.update", $task->id), $payload, $headers);

		$response->assertStatus(200)
						->assertJson([
							"data" =>[
								"id" => $task->id,
								"title" => "this is an updated title",
								"description" => "this is an updated description",
								"done" =>1
							]
						]);
							
		$this->assertEquals("this is an updated title", $this->user->tasks()->first()->title);

	}

	public function testShowTask()
	{
		$token = $this->authenticate();

		$task = factory(Task::class)->create([
			"title" => 'this is a title',
			"description" => "this is a description",
			"user_id" =>$this->user->id,
		]);

		$headers = ["Authorization" =>"Bearer $token"];

		$response = $this->json("GET", route("tasks.show", $task->id), $headers);

		$response->assertStatus(200)
						 ->assertJson([
							"data" =>[
								"id" => $task->id,
								"title" => 'this is a title',
								"description" => "this is a description",
								"done" => 0
							]
						]);

	}

	public function testDeleteTask()
	{
		$token = $this->authenticate();

		$task = factory(Task::class)->create([
			"title" => 'this is a title',
			"description" => "this is a description",
			"user_id" =>$this->user->id,
		]);

		$headers = ["Authorization" =>"Bearer $token"];

		$this->json("DELETE", route("tasks.destroy", $task->id), $headers)
				 ->assertStatus(204);

	}
}
