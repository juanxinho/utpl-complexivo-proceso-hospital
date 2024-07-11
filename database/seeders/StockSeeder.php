<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicines = [
            ['item_name' => 'Aspirin', 'quantity' => 100, 'price' => 0.50],
            ['item_name' => 'Ibuprofen', 'quantity' => 150, 'price' => 0.80],
            ['item_name' => 'Paracetamol', 'quantity' => 200, 'price' => 0.60],
            ['item_name' => 'Amoxicillin', 'quantity' => 120, 'price' => 1.20],
            ['item_name' => 'Cetirizine', 'quantity' => 130, 'price' => 0.70],
            ['item_name' => 'Diphenhydramine', 'quantity' => 110, 'price' => 0.90],
            ['item_name' => 'Ciprofloxacin', 'quantity' => 140, 'price' => 1.50],
            ['item_name' => 'Doxycycline', 'quantity' => 100, 'price' => 1.00],
            ['item_name' => 'Hydrochlorothiazide', 'quantity' => 160, 'price' => 0.65],
            ['item_name' => 'Lisinopril', 'quantity' => 170, 'price' => 0.75],
            ['item_name' => 'Metformin', 'quantity' => 200, 'price' => 0.55],
            ['item_name' => 'Omeprazole', 'quantity' => 180, 'price' => 1.10],
            ['item_name' => 'Simvastatin', 'quantity' => 190, 'price' => 0.95],
            ['item_name' => 'Amlodipine', 'quantity' => 175, 'price' => 0.85],
            ['item_name' => 'Azithromycin', 'quantity' => 150, 'price' => 1.30],
            ['item_name' => 'Citalopram', 'quantity' => 140, 'price' => 1.25],
            ['item_name' => 'Clonazepam', 'quantity' => 130, 'price' => 1.40],
            ['item_name' => 'Diclofenac', 'quantity' => 120, 'price' => 1.15],
            ['item_name' => 'Duloxetine', 'quantity' => 110, 'price' => 1.50],
            ['item_name' => 'Escitalopram', 'quantity' => 100, 'price' => 1.35],
            ['item_name' => 'Furosemide', 'quantity' => 90, 'price' => 0.75],
            ['item_name' => 'Gabapentin', 'quantity' => 80, 'price' => 1.20],
            ['item_name' => 'Hydrochlorothiazide', 'quantity' => 70, 'price' => 0.90],
            ['item_name' => 'Levofloxacin', 'quantity' => 60, 'price' => 1.10],
            ['item_name' => 'Lorazepam', 'quantity' => 50, 'price' => 1.30],
            ['item_name' => 'Losartan', 'quantity' => 75, 'price' => 0.95],
            ['item_name' => 'Meloxicam', 'quantity' => 85, 'price' => 0.85],
            ['item_name' => 'Metoprolol', 'quantity' => 95, 'price' => 0.80],
            ['item_name' => 'Montelukast', 'quantity' => 105, 'price' => 0.70],
            ['item_name' => 'Naproxen', 'quantity' => 115, 'price' => 0.90],
            ['item_name' => 'Olmesartan', 'quantity' => 125, 'price' => 1.00],
            ['item_name' => 'Pantoprazole', 'quantity' => 135, 'price' => 1.10],
            ['item_name' => 'Prednisone', 'quantity' => 145, 'price' => 1.20],
            ['item_name' => 'Ranitidine', 'quantity' => 155, 'price' => 1.30],
            ['item_name' => 'Rosuvastatin', 'quantity' => 165, 'price' => 1.40],
            ['item_name' => 'Sertraline', 'quantity' => 175, 'price' => 1.50],
            ['item_name' => 'Sildenafil', 'quantity' => 185, 'price' => 1.60],
            ['item_name' => 'Spironolactone', 'quantity' => 195, 'price' => 1.70],
            ['item_name' => 'Tamsulosin', 'quantity' => 205, 'price' => 1.80],
            ['item_name' => 'Tramadol', 'quantity' => 215, 'price' => 1.90],
            ['item_name' => 'Trazodone', 'quantity' => 225, 'price' => 2.00],
            ['item_name' => 'Valsartan', 'quantity' => 235, 'price' => 2.10],
            ['item_name' => 'Venlafaxine', 'quantity' => 245, 'price' => 2.20],
            ['item_name' => 'Warfarin', 'quantity' => 255, 'price' => 2.30],
            ['item_name' => 'Zolpidem', 'quantity' => 265, 'price' => 2.40],
            ['item_name' => 'Metoclopramide', 'quantity' => 275, 'price' => 2.50],
            ['item_name' => 'Atenolol', 'quantity' => 285, 'price' => 2.60],
            ['item_name' => 'Bisoprolol', 'quantity' => 295, 'price' => 2.70],
            ['item_name' => 'Carvedilol', 'quantity' => 305, 'price' => 2.80],
            ['item_name' => 'Diltiazem', 'quantity' => 315, 'price' => 2.90],
        ];

        foreach ($medicines as $medicine) {
            Stock::create($medicine);
        }
    }
}


