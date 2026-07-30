<?php

namespace Tests\Feature;

use App\Livewire\ProfileUpdateForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(ProfileUpdateForm::class);

        $this->assertEquals($user->profile->first_name, $component->state['first_name']);
        $this->assertEquals($user->profile->last_name, $component->state['last_name']);
        $this->assertEquals($user->profile->nid, $component->state['nid']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());
        $location = $this->locationPayload();

        Livewire::test(ProfileUpdateForm::class)
            ->set('state', [
                'first_name' => 'Test',
                'last_name' => 'User',
                'nid' => $this->validEcuadorianId(),
                'phone' => '0995767405',
                'gender' => 'M',
                'dob' => '1986-05-04',
                'email' => 'test@example.com',
                'country_id' => $location['country_id'],
                'state_id' => $location['state_id'],
                'city_id' => $location['city_id'],
                'address' => 'Avenida Universitaria',
            ])
            ->call('updateProfileInformation');

        $this->assertEquals('test@example.com', $user->fresh()->email);
        $this->assertEquals('Test', $user->fresh()->profile->first_name);
        $this->assertEquals('User', $user->fresh()->profile->last_name);
        $this->assertEquals('Avenida Universitaria', $user->fresh()->profile->address);
    }
}
