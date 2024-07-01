<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('specialty')->insert([
            [
                'name' => __('specialties.cardiology'),
                'abbreviation' => 'CARD',
                'description' => __('specialties.cardiology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.dermatology'),
                'abbreviation' => 'DERM',
                'description' => __('specialties.dermatology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.gastroenterology'),
                'abbreviation' => 'GAST',
                'description' => __('specialties.gastroenterology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.neurology'),
                'abbreviation' => 'NEUR',
                'description' => __('specialties.neurology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.pediatrics'),
                'abbreviation' => 'PED',
                'description' => __('specialties.pediatrics_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.orthopedics'),
                'abbreviation' => 'ORTH',
                'description' => __('specialties.orthopedics_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.psychiatry'),
                'abbreviation' => 'PSYCH',
                'description' => __('specialties.psychiatry_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.ophthalmology'),
                'abbreviation' => 'OPHTH',
                'description' => __('specialties.ophthalmology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.urology'),
                'abbreviation' => 'UROL',
                'description' => __('specialties.urology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.oncology'),
                'abbreviation' => 'ONC',
                'description' => __('specialties.oncology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.endocrinology'),
                'abbreviation' => 'ENDO',
                'description' => __('specialties.endocrinology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.pulmonology'),
                'abbreviation' => 'PULM',
                'description' => __('specialties.pulmonology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.rheumatology'),
                'abbreviation' => 'RHEUM',
                'description' => __('specialties.rheumatology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.nephrology'),
                'abbreviation' => 'NEPH',
                'description' => __('specialties.nephrology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.hematology'),
                'abbreviation' => 'HEME',
                'description' => __('specialties.hematology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.radiology'),
                'abbreviation' => 'RAD',
                'description' => __('specialties.radiology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.otolaryngology'),
                'abbreviation' => 'ENT',
                'description' => __('specialties.otolaryngology_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.allergy'),
                'abbreviation' => 'ALL',
                'description' => __('specialties.allergy_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.infectious_disease'),
                'abbreviation' => 'ID',
                'description' => __('specialties.infectious_disease_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => __('specialties.plastic_surgery'),
                'abbreviation' => 'PLS',
                'description' => __('specialties.plastic_surgery_description'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
