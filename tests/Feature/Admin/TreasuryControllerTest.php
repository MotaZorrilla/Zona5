<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Treasury;
use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TreasuryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;
    protected $treasuryRecord;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin role
        $adminRole = Role::create(['name' => 'Admin']);

        // Create admin user
        $this->adminUser = User::factory()->create();
        $this->adminUser->roles()->attach($adminRole->id);

        // Create lodge for testing
        $lodge = Lodge::factory()->create();

        // Create a treasury record for testing
        $this->treasuryRecord = Treasury::factory()->create([
            'user_id' => $this->adminUser->id,
            'lodge_id' => $lodge->id
        ]);
    }

    public function test_treasury_index_accessible_to_admin()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/treasury');

        $response->assertStatus(200);
        $response->assertViewIs('admin.treasury.index');
    }

    public function test_treasury_index_requires_authentication()
    {
        $response = $this->get('/admin/treasury');

        $response->assertRedirect('/login');
    }

    public function test_create_treasury_form()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/treasury/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.treasury.create');
    }

    public function test_store_treasury_record()
    {
        $lodge = Lodge::factory()->create();

        $requestData = [
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'donation',
            'transaction_date' => now()->format('Y-m-d'),
            'reference' => 'REF001',
            'status' => 'completed',
            'lodge_id' => $lodge->id,
            'notes' => 'Test notes'
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/treasury', $requestData);

        $response->assertRedirect('/admin/treasury');
        $response->assertSessionHas('success', 'Movimiento registrado exitosamente.');

        $this->assertDatabaseHas('treasury', [
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00
        ]);
    }

    public function test_store_treasury_record_validation()
    {
        $requestData = [
            'description' => '', // Required field
            'type' => 'invalid_type', // Invalid type
            'amount' => -10, // Invalid amount
            'category' => 'test', // Required field
            'transaction_date' => 'invalid_date' // Invalid date
        ];

        $response = $this->actingAs($this->adminUser)
            ->post('/admin/treasury', $requestData);

        $response->assertSessionHasErrors([
            'description',
            'type',
            'amount',
            'transaction_date'
        ]);
    }

    public function test_show_treasury_record()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/treasury/' . $this->treasuryRecord->id);

        $response->assertStatus(200);
        $response->assertViewIs('admin.treasury.show');
        $response->assertViewHas('treasury');
    }

    public function test_edit_treasury_record()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/treasury/' . $this->treasuryRecord->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.treasury.edit');
        $response->assertViewHas('treasury');
    }

    public function test_update_treasury_record()
    {
        $requestData = [
            'description' => 'Updated Treasury Entry',
            'type' => 'expense',
            'amount' => 200.00,
            'category' => 'maintenance',
            'transaction_date' => now()->format('Y-m-d'),
            'reference' => 'REF002',
            'status' => 'pending',
            'notes' => 'Updated notes'
        ];

        $response = $this->actingAs($this->adminUser)
            ->put('/admin/treasury/' . $this->treasuryRecord->id, $requestData);

        $response->assertRedirect('/admin/treasury');
        $response->assertSessionHas('success', 'Movimiento actualizado exitosamente.');

        $this->assertDatabaseHas('treasury', [
            'id' => $this->treasuryRecord->id,
            'description' => 'Updated Treasury Entry',
            'type' => 'expense',
            'amount' => 200.00
        ]);
    }

    public function test_update_treasury_record_validation()
    {
        $requestData = [
            'description' => '', // Required field
            'type' => 'invalid_type', // Invalid type
            'amount' => -10, // Invalid amount
        ];

        $response = $this->actingAs($this->adminUser)
            ->put('/admin/treasury/' . $this->treasuryRecord->id, $requestData);

        $response->assertSessionHasErrors([
            'description',
            'type',
            'amount'
        ]);
    }

    public function test_delete_treasury_record()
    {
        $treasuryRecord = Treasury::factory()->create([
            'user_id' => $this->adminUser->id
        ]);

        $response = $this->actingAs($this->adminUser)
            ->delete('/admin/treasury/' . $treasuryRecord->id);

        $response->assertRedirect('/admin/treasury');
        $response->assertSessionHas('success', 'Movimiento eliminado exitosamente.');

        $this->assertDatabaseMissing('treasury', [
            'id' => $treasuryRecord->id
        ]);
    }

    public function test_treasury_summary()
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/treasury/summary');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'total_balance',
            'monthly_income',
            'monthly_expense',
            'recent_transactions'
        ]);
    }
}