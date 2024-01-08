<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvesFuncionals extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_when_navigate_to_event_index_expect_show_event_list(): void
    {
        $response = $this->get('events');
        $response->assertSeeText('event list');
        $response->assertOk();
    }
    // public static function newValidEventTest(): array
    // {

    //     $task = \Database\Factories\EventFactory::

    //     return [

    //     ];
    // }
}
