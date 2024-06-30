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
        DB::table('especialidad')->insert([
            [
                'nombre' => __('especialidades.cardiology'),
                'abreviatura' => 'CARD',
                'descripcion' => __('especialidades.cardiology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.dermatology'),
                'abreviatura' => 'DERM',
                'descripcion' => __('especialidades.dermatology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.gastroenterology'),
                'abreviatura' => 'GAST',
                'descripcion' => __('especialidades.gastroenterology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.neurology'),
                'abreviatura' => 'NEUR',
                'descripcion' => __('especialidades.neurology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.pediatrics'),
                'abreviatura' => 'PED',
                'descripcion' => __('especialidades.pediatrics_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.orthopedics'),
                'abreviatura' => 'ORTH',
                'descripcion' => __('especialidades.orthopedics_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.psychiatry'),
                'abreviatura' => 'PSYCH',
                'descripcion' => __('especialidades.psychiatry_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.ophthalmology'),
                'abreviatura' => 'OPHTH',
                'descripcion' => __('especialidades.ophthalmology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.urology'),
                'abreviatura' => 'UROL',
                'descripcion' => __('especialidades.urology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.oncology'),
                'abreviatura' => 'ONC',
                'descripcion' => __('especialidades.oncology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.endocrinology'),
                'abreviatura' => 'ENDO',
                'descripcion' => __('especialidades.endocrinology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.pulmonology'),
                'abreviatura' => 'PULM',
                'descripcion' => __('especialidades.pulmonology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.rheumatology'),
                'abreviatura' => 'RHEUM',
                'descripcion' => __('especialidades.rheumatology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.nephrology'),
                'abreviatura' => 'NEPH',
                'descripcion' => __('especialidades.nephrology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.hematology'),
                'abreviatura' => 'HEME',
                'descripcion' => __('especialidades.hematology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.radiology'),
                'abreviatura' => 'RAD',
                'descripcion' => __('especialidades.radiology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.otolaryngology'),
                'abreviatura' => 'ENT',
                'descripcion' => __('especialidades.otolaryngology_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.allergy'),
                'abreviatura' => 'ALL',
                'descripcion' => __('especialidades.allergy_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.infectious_disease'),
                'abreviatura' => 'ID',
                'descripcion' => __('especialidades.infectious_disease_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => __('especialidades.plastic_surgery'),
                'abreviatura' => 'PLS',
                'descripcion' => __('especialidades.plastic_surgery_description'),
                'estado' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
