<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    // Test create transaction
    public function test_user_can_create_transaction()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/transactions', [
            'title'    => 'Salary',
            'amount'   => 3000,
            'type'     => 'income',
            'category' => 'Work',
            'date'     => '2026-03-01',
        ]);

        $response->assertRedirect('/transactions');
        $this->assertDatabaseHas('transactions', ['title' => 'Salary']);
    }

    // Test read transactions
    public function test_user_can_read_transactions()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Transaction::create([
            'user_id'  => $user->id,
            'title'    => 'Groceries',
            'amount'   => 150,
            'type'     => 'expense',
            'category' => 'Food',
            'date'     => '2026-03-01',
        ]);

        $response = $this->get('/transactions');
        $response->assertStatus(200);
        $response->assertSee('Groceries');
    }

    // Test update transaction
    public function test_user_can_update_transaction()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $transaction = Transaction::create([
            'user_id'  => $user->id,
            'title'    => 'Old Title',
            'amount'   => 100,
            'type'     => 'expense',
            'category' => 'Food',
            'date'     => '2026-03-01',
        ]);

        $response = $this->put("/transactions/{$transaction->id}", [
            'title'    => 'New Title',
            'amount'   => 200,
            'type'     => 'expense',
            'category' => 'Food',
            'date'     => '2026-03-01',
        ]);

        $response->assertRedirect('/transactions');
        $this->assertDatabaseHas('transactions', ['title' => 'New Title']);
    }

    // Test delete transaction
    public function test_user_can_delete_transaction()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $transaction = Transaction::create([
            'user_id'  => $user->id,
            'title'    => 'To Delete',
            'amount'   => 50,
            'type'     => 'expense',
            'category' => 'Misc',
            'date'     => '2026-03-01',
        ]);

        $response = $this->delete("/transactions/{$transaction->id}");

        $response->assertRedirect('/transactions');
        $this->assertDatabaseMissing('transactions', ['title' => 'To Delete']);
    }
}