<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
	//use migrations and seed the database before each test

		use CreatesApplication , DatabaseMigrations;
		
		/*public function setUp()
		{
			parent::setUp();
			Artisan::call('db:seed');
		}*/
}
