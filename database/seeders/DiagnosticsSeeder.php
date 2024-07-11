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
            ['code' => 'D001', 'description' => __('diagnostics.hypertension')],
            ['code' => 'D002', 'description' => __('diagnostics.diabetes')],
            ['code' => 'D003', 'description' => __('diagnostics.asthma')],
            ['code' => 'D004', 'description' => __('diagnostics.covid')],
            ['code' => 'D005', 'description' => __('diagnostics.heart_disease')],
            ['code' => 'D006', 'description' => __('diagnostics.cancer')],
            ['code' => 'D007', 'description' => __('diagnostics.stroke')],
            ['code' => 'D008', 'description' => __('diagnostics.chronic_kidney_disease')],
            ['code' => 'D009', 'description' => __('diagnostics.liver_disease')],
            ['code' => 'D010', 'description' => __('diagnostics.tuberculosis')],
            ['code' => 'D011', 'description' => __('diagnostics.pneumonia')],
            ['code' => 'D012', 'description' => __('diagnostics.bronchitis')],
            ['code' => 'D013', 'description' => __('diagnostics.anemia')],
            ['code' => 'D014', 'description' => __('diagnostics.hiv')],
            ['code' => 'D015', 'description' => __('diagnostics.influenza')],
            ['code' => 'D016', 'description' => __('diagnostics.gastroenteritis')],
            ['code' => 'D017', 'description' => __('diagnostics.migraine')],
            ['code' => 'D018', 'description' => __('diagnostics.arthritis')],
            ['code' => 'D019', 'description' => __('diagnostics.osteoporosis')],
            ['code' => 'D020', 'description' => __('diagnostics.parkinsons')],
            ['code' => 'D021', 'description' => __('diagnostics.epilepsy')],
            ['code' => 'D022', 'description' => __('diagnostics.multiple_sclerosis')],
            ['code' => 'D023', 'description' => __('diagnostics.alzheimers')],
            ['code' => 'D024', 'description' => __('diagnostics.chronic_fatigue')],
            ['code' => 'D025', 'description' => __('diagnostics.depression')],
            ['code' => 'D026', 'description' => __('diagnostics.bipolar_disorder')],
            ['code' => 'D027', 'description' => __('diagnostics.schizophrenia')],
            ['code' => 'D028', 'description' => __('diagnostics.anxiety_disorder')],
            ['code' => 'D029', 'description' => __('diagnostics.ptsd')],
            ['code' => 'D030', 'description' => __('diagnostics.ocd')],
            ['code' => 'D031', 'description' => __('diagnostics.panic_disorder')],
            ['code' => 'D032', 'description' => __('diagnostics.social_anxiety')],
            ['code' => 'D033', 'description' => __('diagnostics.eating_disorders')],
            ['code' => 'D034', 'description' => __('diagnostics.autism')],
            ['code' => 'D035', 'description' => __('diagnostics.adhd')],
            ['code' => 'D036', 'description' => __('diagnostics.cystic_fibrosis')],
            ['code' => 'D037', 'description' => __('diagnostics.sickle_cell')],
            ['code' => 'D038', 'description' => __('diagnostics.hemophilia')],
            ['code' => 'D039', 'description' => __('diagnostics.thalassemia')],
            ['code' => 'D040', 'description' => __('diagnostics.gout')],
            ['code' => 'D041', 'description' => __('diagnostics.lupus')],
            ['code' => 'D042', 'description' => __('diagnostics.crohns')],
            ['code' => 'D043', 'description' => __('diagnostics.ulcerative_colitis')],
            ['code' => 'D044', 'description' => __('diagnostics.celiac')],
            ['code' => 'D045', 'description' => __('diagnostics.ibs')],
            ['code' => 'D046', 'description' => __('diagnostics.hepatitis_b')],
            ['code' => 'D047', 'description' => __('diagnostics.hepatitis_c')],
            ['code' => 'D048', 'description' => __('diagnostics.mononucleosis')],
            ['code' => 'D049', 'description' => __('diagnostics.conjunctivitis')],
            ['code' => 'D050', 'description' => __('diagnostics.psoriasis')],
        ];

        foreach ($diagnostics as $diagnostic) {
            DB::table('diagnostics')->insert($diagnostic);
        }
    }
}
