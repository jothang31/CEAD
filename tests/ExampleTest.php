<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/');
        $this->visit('membersadministration');
        $this->visit('me');
        $this->visit('login');

        $this->visit('user/municipalities');
        $this->visit('user/zones');
        $this->visit('user')
             ->press('inputSave');
    }
}
