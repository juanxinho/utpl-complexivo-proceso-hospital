<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalTests extends Seeder
{
    public function run()
    {
        $medicalTests = [
            ['code' => 'MT001', 'name' => __('medical_tests.complete_blood_count'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT002', 'name' => __('medical_tests.x_ray'), 'category' => __('medical_tests.imaging')],
            ['code' => 'MT003', 'name' => __('medical_tests.mri'), 'category' => __('medical_tests.imaging')],
            ['code' => 'MT004', 'name' => __('medical_tests.urinalysis'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT005', 'name' => __('medical_tests.liver_function_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT006', 'name' => __('medical_tests.blood_sugar_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT007', 'name' => __('medical_tests.ecg'), 'category' => __('medical_tests.cardiology')],
            ['code' => 'MT008', 'name' => __('medical_tests.echocardiogram'), 'category' => __('medical_tests.cardiology')],
            ['code' => 'MT009', 'name' => __('medical_tests.thyroid_function_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT010', 'name' => __('medical_tests.ct_scan'), 'category' => __('medical_tests.imaging')],
            ['code' => 'MT011', 'name' => __('medical_tests.mammography'), 'category' => __('medical_tests.imaging')],
            ['code' => 'MT012', 'name' => __('medical_tests.biopsy'), 'category' => __('medical_tests.pathology')],
            ['code' => 'MT013', 'name' => __('medical_tests.blood_pressure_test'), 'category' => __('medical_tests.general')],
            ['code' => 'MT014', 'name' => __('medical_tests.pulmonary_function_test'), 'category' => __('medical_tests.pulmonology')],
            ['code' => 'MT015', 'name' => __('medical_tests.allergy_test'), 'category' => __('medical_tests.immunology')],
            ['code' => 'MT016', 'name' => __('medical_tests.stool_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT017', 'name' => __('medical_tests.blood_culture'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT018', 'name' => __('medical_tests.cardiac_stress_test'), 'category' => __('medical_tests.cardiology')],
            ['code' => 'MT019', 'name' => __('medical_tests.genetic_test'), 'category' => __('medical_tests.genetics')],
            ['code' => 'MT020', 'name' => __('medical_tests.cholesterol_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT021', 'name' => __('medical_tests.electrolyte_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT022', 'name' => __('medical_tests.hormone_test'), 'category' => __('medical_tests.endocrinology')],
            ['code' => 'MT023', 'name' => __('medical_tests.amniocentesis'), 'category' => __('medical_tests.obstetrics')],
            ['code' => 'MT024', 'name' => __('medical_tests.pap_smear'), 'category' => __('medical_tests.gynecology')],
            ['code' => 'MT025', 'name' => __('medical_tests.bilirubin_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT026', 'name' => __('medical_tests.albumin_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT027', 'name' => __('medical_tests.prothrombin_time_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT028', 'name' => __('medical_tests.vitamin_d_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT029', 'name' => __('medical_tests.bone_density_test'), 'category' => __('medical_tests.imaging')],
            ['code' => 'MT030', 'name' => __('medical_tests.hemoglobin_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT031', 'name' => __('medical_tests.serum_iron_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT032', 'name' => __('medical_tests.lipid_profile'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT033', 'name' => __('medical_tests.arterial_blood_gas_test'), 'category' => __('medical_tests.pulmonology')],
            ['code' => 'MT034', 'name' => __('medical_tests.rheumatoid_factor_test'), 'category' => __('medical_tests.rheumatology')],
            ['code' => 'MT035', 'name' => __('medical_tests.fasting_blood_sugar_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT036', 'name' => __('medical_tests.blood_urea_nitrogen_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT037', 'name' => __('medical_tests.creatinine_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT038', 'name' => __('medical_tests.lactate_dehydrogenase_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT039', 'name' => __('medical_tests.prostate_specific_antigen_test'), 'category' => __('medical_tests.urology')],
            ['code' => 'MT040', 'name' => __('medical_tests.hepatitis_panel'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT041', 'name' => __('medical_tests.hiv_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT042', 'name' => __('medical_tests.syphilis_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT043', 'name' => __('medical_tests.pregnancy_test'), 'category' => __('medical_tests.obstetrics')],
            ['code' => 'MT044', 'name' => __('medical_tests.blood_glucose_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT045', 'name' => __('medical_tests.insulin_test'), 'category' => __('medical_tests.endocrinology')],
            ['code' => 'MT046', 'name' => __('medical_tests.troponin_test'), 'category' => __('medical_tests.cardiology')],
            ['code' => 'MT047', 'name' => __('medical_tests.d_dimer_test'), 'category' => __('medical_tests.hematology')],
            ['code' => 'MT048', 'name' => __('medical_tests.c_reactive_protein_test'), 'category' => __('medical_tests.immunology')],
            ['code' => 'MT049', 'name' => __('medical_tests.folate_test'), 'category' => __('medical_tests.laboratory')],
            ['code' => 'MT050', 'name' => __('medical_tests.ferritin_test'), 'category' => __('medical_tests.laboratory')],
        ];

        DB::table('medical_tests')->insert($medicalTests);
    }
}
