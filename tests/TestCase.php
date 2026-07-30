<?php

namespace Tests;

use App\Helpers\EcuadorianIdGenerator;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function validEcuadorianId(): string
    {
        return EcuadorianIdGenerator::generateId();
    }

    /**
     * @return array{country_id: int, state_id: int, city_id: int}
     */
    protected function locationPayload(): array
    {
        $country = Country::firstOrCreate(
            ['name' => 'ecuador'],
            ['status' => 'active']
        );

        $state = State::firstOrCreate(
            ['country_id' => $country->id, 'name' => 'loja'],
            ['status' => 'active']
        );

        $city = City::firstOrCreate(
            ['state_id' => $state->id, 'name' => 'loja'],
            ['status' => 'active']
        );

        return [
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $city->id,
        ];
    }
}
