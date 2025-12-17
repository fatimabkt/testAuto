<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Stagiaire;

class StagiaireCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_stagiaire()
    {
        /* $this->post(...) : Laravel simule une requête HTTP POST
        route('stagiaire.store') : récupère l’URL de la route nommée */
        $response = $this->post(route('stagiaire.store'), [
            'nom' => 'EL Amrani',
            'prenom' => 'said',
            'datenaissance' => '2000-01-01',
        ]);
        /*302 = redirection.Dans un CRUD Laravel, après store, on fait souvent return redirect(...)*/
        $response->assertStatus(302); // souvent redirect après store
        /*vérifie si vraiment l'objet a été créé*/
        $this->assertDatabaseHas('stagiaires', [
            'nom' => 'EL Amrani',
            'prenom' => 'said',
        ]);
    }

    public function test_update_stagiaire()
    {
        $stagiaire = Stagiaire::factory()->create([
            'nom' => 'fatima',
            'prenom' => 'bkt',
            'datenaissance' => '2000-02-12'
        ]);

        $response = $this->put(route('stagiaire.update', $stagiaire->id), [
            'nom' => 'nabil',
            'prenom' => 'nabil',
            'datenaissance' => $stagiaire->datenaissance,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('stagiaires', [
            'id' => $stagiaire->id,
            'nom' => 'nabil',
            'prenom' => 'nabil',
        ]);
    }

    public function test_delete_stagiaire()
    {
        $stagiaire = Stagiaire::factory()->create();

        $response = $this->delete(route('stagiaire.destroy', $stagiaire));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('stagiaires', [
            'id' => $stagiaire->id,
        ]);
    }
}
