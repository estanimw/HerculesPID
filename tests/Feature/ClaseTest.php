<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class ClaseTest extends TestCase
{

	protected function clasesRoute()
    {
        return route('clases');
    }
    protected function clasesApiRoute()
    {
        return route('clasesCargadas');
    }
    protected function loginPostRoute()
    {
        return route('login');
    }
    protected function clasePostRoute()
    {
        return route('cargarClase');
    }
    public function testClasesViewWorks()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

    	$response = $this->get($this->clasesRoute());
        $response->assertSuccessful();
        $response->assertViewIs('clases');
    }
    public function testClasesFetchApiWorks()
    {

        $user = User::factory()->create();
        $this->actingAs($user);

    	$response = $this->get($this->clasesApiRoute());
        $response->assertSuccessful();
        $response->assertStatus(200);
    }
    public function testClaseCanBeAddedToDb()
    {

        $user = User::factory()->create();
        $this->actingAs($user);
        $evento = Evento::factory()->create();
		$this->withoutMiddleware();
        $response = $this->post('cargarClase', [
            'title' => $evento->title,
            'day' => '1',
            'start' => $evento->start,
            'end' => $evento->end,
            'color' => $evento->color
        ]);

        $response->assertStatus(200);
    }
}
