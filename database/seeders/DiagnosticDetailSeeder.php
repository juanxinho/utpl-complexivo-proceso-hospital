<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosticDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnosticDetails = [
            ['code' => 'D001', 'description' => json_encode(['en' => 'Hypertension', 'es' => 'Hipertensión'])],
            ['code' => 'D002', 'description' => json_encode(['en' => 'Diabetes', 'es' => 'Diabetes'])],
            ['code' => 'D003', 'description' => json_encode(['en' => 'Asthma', 'es' => 'Asma'])],
            ['code' => 'D004', 'description' => json_encode(['en' => 'COVID-19', 'es' => 'COVID-19'])],
            ['code' => 'D005', 'description' => json_encode(['en' => 'Heart Disease', 'es' => 'Enfermedad Cardíaca'])],
            ['code' => 'D006', 'description' => json_encode(['en' => 'Cancer', 'es' => 'Cáncer'])],
            ['code' => 'D007', 'description' => json_encode(['en' => 'Stroke', 'es' => 'Accidente Cerebrovascular'])],
            ['code' => 'D008', 'description' => json_encode(['en' => 'Chronic Kidney Disease', 'es' => 'Enfermedad Renal Crónica'])],
            ['code' => 'D009', 'description' => json_encode(['en' => 'Liver Disease', 'es' => 'Enfermedad Hepática'])],
            ['code' => 'D010', 'description' => json_encode(['en' => 'Tuberculosis', 'es' => 'Tuberculosis'])],
            ['code' => 'D011', 'description' => json_encode(['en' => 'Pneumonia', 'es' => 'Neumonía'])],
            ['code' => 'D012', 'description' => json_encode(['en' => 'Bronchitis', 'es' => 'Bronquitis'])],
            ['code' => 'D013', 'description' => json_encode(['en' => 'Anemia', 'es' => 'Anemia'])],
            ['code' => 'D014', 'description' => json_encode(['en' => 'HIV/AIDS', 'es' => 'VIH/SIDA'])],
            ['code' => 'D015', 'description' => json_encode(['en' => 'Influenza', 'es' => 'Gripe'])],
            ['code' => 'D016', 'description' => json_encode(['en' => 'Gastroenteritis', 'es' => 'Gastroenteritis'])],
            ['code' => 'D017', 'description' => json_encode(['en' => 'Migraine', 'es' => 'Migraña'])],
            ['code' => 'D018', 'description' => json_encode(['en' => 'Arthritis', 'es' => 'Artritis'])],
            ['code' => 'D019', 'description' => json_encode(['en' => 'Osteoporosis', 'es' => 'Osteoporosis'])],
            ['code' => 'D020', 'description' => json_encode(['en' => "Parkinson's Disease", 'es' => 'Enfermedad de Parkinson'])],
            ['code' => 'D021', 'description' => json_encode(['en' => 'Epilepsy', 'es' => 'Epilepsia'])],
            ['code' => 'D022', 'description' => json_encode(['en' => 'Multiple Sclerosis', 'es' => 'Esclerosis Múltiple'])],
            ['code' => 'D023', 'description' => json_encode(['en' => "Alzheimer's Disease", 'es' => 'Enfermedad de Alzheimer'])],
            ['code' => 'D024', 'description' => json_encode(['en' => 'Chronic Fatigue Syndrome', 'es' => 'Síndrome de Fatiga Crónica'])],
            ['code' => 'D025', 'description' => json_encode(['en' => 'Depression', 'es' => 'Depresión'])],
            ['code' => 'D026', 'description' => json_encode(['en' => 'Bipolar Disorder', 'es' => 'Trastorno Bipolar'])],
            ['code' => 'D027', 'description' => json_encode(['en' => 'Schizophrenia', 'es' => 'Esquizofrenia'])],
            ['code' => 'D028', 'description' => json_encode(['en' => 'Anxiety Disorder', 'es' => 'Trastorno de Ansiedad'])],
            ['code' => 'D029', 'description' => json_encode(['en' => 'Post-Traumatic Stress Disorder', 'es' => 'Trastorno de Estrés Postraumático'])],
            ['code' => 'D030', 'description' => json_encode(['en' => 'Obsessive-Compulsive Disorder', 'es' => 'Trastorno Obsesivo-Compulsivo'])],
            ['code' => 'D031', 'description' => json_encode(['en' => 'Panic Disorder', 'es' => 'Trastorno de Pánico'])],
            ['code' => 'D032', 'description' => json_encode(['en' => 'Social Anxiety Disorder', 'es' => 'Trastorno de Ansiedad Social'])],
            ['code' => 'D033', 'description' => json_encode(['en' => 'Eating Disorders', 'es' => 'Trastornos Alimentarios'])],
            ['code' => 'D034', 'description' => json_encode(['en' => 'Autism Spectrum Disorder', 'es' => 'Trastorno del Espectro Autista'])],
            ['code' => 'D035', 'description' => json_encode(['en' => 'Attention-Deficit/Hyperactivity Disorder', 'es' => 'Trastorno por Déficit de Atención e Hiperactividad'])],
            ['code' => 'D036', 'description' => json_encode(['en' => 'Cystic Fibrosis', 'es' => 'Fibrosis Quística'])],
            ['code' => 'D037', 'description' => json_encode(['en' => 'Sickle Cell Disease', 'es' => 'Enfermedad de Células Falciformes'])],
            ['code' => 'D038', 'description' => json_encode(['en' => 'Hemophilia', 'es' => 'Hemofilia'])],
            ['code' => 'D039', 'description' => json_encode(['en' => 'Thalassemia', 'es' => 'Talassemia'])],
            ['code' => 'D040', 'description' => json_encode(['en' => 'Gout', 'es' => 'Gota'])],
            ['code' => 'D041', 'description' => json_encode(['en' => 'Lupus', 'es' => 'Lupus'])],
            ['code' => 'D042', 'description' => json_encode(['en' => "Crohn's Disease", 'es' => 'Enfermedad de Crohn'])],
            ['code' => 'D043', 'description' => json_encode(['en' => 'Ulcerative Colitis', 'es' => 'Colitis Ulcerosa'])],
            ['code' => 'D044', 'description' => json_encode(['en' => 'Celiac Disease', 'es' => 'Enfermedad Celíaca'])],
            ['code' => 'D045', 'description' => json_encode(['en' => 'Irritable Bowel Syndrome', 'es' => 'Síndrome del Intestino Irritable'])],
            ['code' => 'D046', 'description' => json_encode(['en' => 'Hepatitis B', 'es' => 'Hepatitis B'])],
            ['code' => 'D047', 'description' => json_encode(['en' => 'Hepatitis C', 'es' => 'Hepatitis C'])],
            ['code' => 'D048', 'description' => json_encode(['en' => 'Mononucleosis', 'es' => 'Mononucleosis'])],
            ['code' => 'D049', 'description' => json_encode(['en' => 'Conjunctivitis', 'es' => 'Conjuntivitis'])],
            ['code' => 'D050', 'description' => json_encode(['en' => 'Psoriasis', 'es' => 'Psoriasis'])],
        ];

        foreach ($diagnosticDetails as $detail) {
            DB::table('diagnostic_details')->insert($detail);
        }
    }
}
