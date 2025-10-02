<?php

namespace Tests\Unit;

use App\Models\Treasury;
use App\Models\User;
use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TreasuryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_treasury_record()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();

        $treasury = Treasury::create([
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'donation',
            'transaction_date' => '2023-01-01',
            'reference' => 'REF001',
            'status' => 'completed',
            'user_id' => $user->id,
            'lodge_id' => $lodge->id,
            'notes' => 'Test notes',
        ]);

        $this->assertDatabaseHas('treasury', [
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
        ]);
    }

    public function test_treasury_belongs_to_user()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();
        
        $treasury = Treasury::create([
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'donation',
            'transaction_date' => '2023-01-01',
            'reference' => 'REF001',
            'status' => 'completed',
            'user_id' => $user->id,
            'lodge_id' => $lodge->id,
        ]);

        $this->assertInstanceOf(User::class, $treasury->user);
        $this->assertEquals($user->id, $treasury->user->id);
    }

    public function test_treasury_belongs_to_lodge()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();
        
        $treasury = Treasury::create([
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'donation',
            'transaction_date' => '2023-01-01',
            'reference' => 'REF001',
            'status' => 'completed',
            'user_id' => $user->id,
            'lodge_id' => $lodge->id,
        ]);

        $this->assertInstanceOf(Lodge::class, $treasury->lodge);
        $this->assertEquals($lodge->id, $treasury->lodge->id);
    }

    public function test_amount_casting()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();

        $treasury = Treasury::create([
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => '250.75',
            'category' => 'donation',
            'transaction_date' => '2023-01-01',
            'reference' => 'REF001',
            'status' => 'completed',
            'user_id' => $user->id,
            'lodge_id' => $lodge->id,
        ]);

        $this->assertEquals(250.75, $treasury->amount);
        $this->assertIsNumeric($treasury->amount);
    }

    public function test_transaction_date_casting()
    {
        $user = User::factory()->create();
        $lodge = Lodge::factory()->create();

        $treasury = Treasury::create([
            'description' => 'Test Treasury Entry',
            'type' => 'income',
            'amount' => 100.00,
            'category' => 'donation',
            'transaction_date' => '2023-05-15',
            'reference' => 'REF001',
            'status' => 'completed',
            'user_id' => $user->id,
            'lodge_id' => $lodge->id,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $treasury->transaction_date);
        $this->assertEquals('2023-05-15', $treasury->transaction_date->format('Y-m-d'));
    }
}