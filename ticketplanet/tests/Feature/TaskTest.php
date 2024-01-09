<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Database\Factories\EventFactory;

class TaskTest extends TestCase
{
  use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_when_navigate_to_event_index_expect_show_event_list(): void
    {
        $response = $this->get('/events');
        $response->assertOk();
    }
    // public static function newValidEventTest(): array
    // {

    //     $task = \Database\Factories\EventFactory::

    //     return [

    //     ];
    // }
    public function test_when_write_on_seeker_with_mayus_show_event_list(): void
    {
      $response = $this->get('/events');
      $busqueda='PRUEBA';
      $category=null;
        $response->Event::eventosBuscados($busqueda,$category);
        $response->assertOk();
      
    }
    public function test_when_write_on_seeker_with_min_show_event_list(): void
    {
      $response = $this->get('/events');
      $busqueda='prueba';
      $category=null;
        $response->Event::eventosBuscados($busqueda,$category);
        $response->assertOk();

    }
    public function test_when_write_on_seeker_with_accent_show_event_list(): void
    {
      $response = $this->get('/events');
      $busqueda='pruéba';
      $category=null;
        $response->Event::eventosBuscados($busqueda,$category);
        $response->assertOk();

    }
}
