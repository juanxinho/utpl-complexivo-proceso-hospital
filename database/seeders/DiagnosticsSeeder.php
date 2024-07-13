<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnostics = [
            ['code' => 'I10', 'description' => __('diagnostics.hypertension')],
            ['code' => 'E11', 'description' => __('diagnostics.diabetes')],
            ['code' => 'J45', 'description' => __('diagnostics.asthma')],
            ['code' => 'U07.1', 'description' => __('diagnostics.covid')],
            ['code' => 'I20', 'description' => __('diagnostics.heart_disease')],
            ['code' => 'C00', 'description' => __('diagnostics.cancer')],
            ['code' => 'I63', 'description' => __('diagnostics.stroke')],
            ['code' => 'N18', 'description' => __('diagnostics.chronic_kidney_disease')],
            ['code' => 'K74', 'description' => __('diagnostics.liver_disease')],
            ['code' => 'A15', 'description' => __('diagnostics.tuberculosis')],
            ['code' => 'J18', 'description' => __('diagnostics.pneumonia')],
            ['code' => 'J20', 'description' => __('diagnostics.bronchitis')],
            ['code' => 'D50', 'description' => __('diagnostics.anemia')],
            ['code' => 'B20', 'description' => __('diagnostics.hiv')],
            ['code' => 'J10', 'description' => __('diagnostics.influenza')],
            ['code' => 'A09', 'description' => __('diagnostics.gastroenteritis')],
            ['code' => 'G43', 'description' => __('diagnostics.migraine')],
            ['code' => 'M19', 'description' => __('diagnostics.arthritis')],
            ['code' => 'M81', 'description' => __('diagnostics.osteoporosis')],
            ['code' => 'G20', 'description' => __('diagnostics.parkinsons')],
            ['code' => 'G40', 'description' => __('diagnostics.epilepsy')],
            ['code' => 'G35', 'description' => __('diagnostics.multiple_sclerosis')],
            ['code' => 'G30', 'description' => __('diagnostics.alzheimers')],
            ['code' => 'R53', 'description' => __('diagnostics.chronic_fatigue')],
            ['code' => 'F33', 'description' => __('diagnostics.depression')],
            ['code' => 'F31', 'description' => __('diagnostics.bipolar_disorder')],
            ['code' => 'F20', 'description' => __('diagnostics.schizophrenia')],
            ['code' => 'F41', 'description' => __('diagnostics.anxiety_disorder')],
            ['code' => 'F43.1', 'description' => __('diagnostics.ptsd')],
            ['code' => 'F42', 'description' => __('diagnostics.ocd')],
            ['code' => 'F41.0', 'description' => __('diagnostics.panic_disorder')],
            ['code' => 'F40.1', 'description' => __('diagnostics.social_anxiety')],
            ['code' => 'F50', 'description' => __('diagnostics.eating_disorders')],
            ['code' => 'F84.0', 'description' => __('diagnostics.autism')],
            ['code' => 'F90', 'description' => __('diagnostics.adhd')],
            ['code' => 'E84', 'description' => __('diagnostics.cystic_fibrosis')],
            ['code' => 'D57', 'description' => __('diagnostics.sickle_cell')],
            ['code' => 'D66', 'description' => __('diagnostics.hemophilia')],
            ['code' => 'D56', 'description' => __('diagnostics.thalassemia')],
            ['code' => 'M10', 'description' => __('diagnostics.gout')],
            ['code' => 'M32', 'description' => __('diagnostics.lupus')],
            ['code' => 'K50', 'description' => __('diagnostics.crohns')],
            ['code' => 'K51', 'description' => __('diagnostics.ulcerative_colitis')],
            ['code' => 'K90.0', 'description' => __('diagnostics.celiac')],
            ['code' => 'K58', 'description' => __('diagnostics.ibs')],
            ['code' => 'B18.1', 'description' => __('diagnostics.hepatitis_b')],
            ['code' => 'B18.2', 'description' => __('diagnostics.hepatitis_c')],
            ['code' => 'B27', 'description' => __('diagnostics.mononucleosis')],
            ['code' => 'H10', 'description' => __('diagnostics.conjunctivitis')],
            ['code' => 'L40', 'description' => __('diagnostics.psoriasis')],
        ];

        foreach ($diagnostics as $diagnostic) {
            DB::table('diagnostics')->insert($diagnostic);
        }
    }
}
