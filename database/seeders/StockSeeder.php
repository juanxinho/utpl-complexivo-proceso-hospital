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
            ['item_name' => __('stock.aspirin'), 'quantity' => 100, 'price' => 0.50],
            ['item_name' => __('stock.ibuprofen'), 'quantity' => 150, 'price' => 0.80],
            ['item_name' => __('stock.paracetamol'), 'quantity' => 200, 'price' => 0.60],
            ['item_name' => __('stock.amoxicillin'), 'quantity' => 120, 'price' => 1.20],
            ['item_name' => __('stock.metformin'), 'quantity' => 180, 'price' => 0.40],
            ['item_name' => __('stock.atorvastatin'), 'quantity' => 130, 'price' => 0.90],
            ['item_name' => __('stock.lisinopril'), 'quantity' => 110, 'price' => 0.70],
            ['item_name' => __('stock.omeprazole'), 'quantity' => 140, 'price' => 0.80],
            ['item_name' => __('stock.azithromycin'), 'quantity' => 90, 'price' => 1.00],
            ['item_name' => __('stock.amlodipine'), 'quantity' => 100, 'price' => 0.60],
            ['item_name' => __('stock.hydrochlorothiazide'), 'quantity' => 170, 'price' => 0.50],
            ['item_name' => __('stock.simvastatin'), 'quantity' => 160, 'price' => 0.70],
            ['item_name' => __('stock.citalopram'), 'quantity' => 140, 'price' => 0.90],
            ['item_name' => __('stock.losartan'), 'quantity' => 150, 'price' => 0.80],
            ['item_name' => __('stock.gabapentin'), 'quantity' => 130, 'price' => 1.10],
            ['item_name' => __('stock.pantoprazole'), 'quantity' => 180, 'price' => 0.70],
            ['item_name' => __('stock.prednisone'), 'quantity' => 100, 'price' => 0.60],
            ['item_name' => __('stock.levothyroxine'), 'quantity' => 110, 'price' => 0.50],
            ['item_name' => __('stock.clopidogrel'), 'quantity' => 130, 'price' => 0.90],
            ['item_name' => __('stock.montelukast'), 'quantity' => 140, 'price' => 0.80],
            ['item_name' => __('stock.sertraline'), 'quantity' => 150, 'price' => 1.00],
            ['item_name' => __('stock.furosemide'), 'quantity' => 110, 'price' => 0.70],
            ['item_name' => __('stock.zolpidem'), 'quantity' => 90, 'price' => 1.20],
            ['item_name' => __('stock.tramadol'), 'quantity' => 100, 'price' => 1.00],
            ['item_name' => __('stock.escitalopram'), 'quantity' => 160, 'price' => 1.10],
            ['item_name' => __('stock.meloxicam'), 'quantity' => 130, 'price' => 0.80],
            ['item_name' => __('stock.allopurinol'), 'quantity' => 140, 'price' => 0.90],
            ['item_name' => __('stock.ciprofloxacin'), 'quantity' => 120, 'price' => 1.00],
            ['item_name' => __('stock.doxycycline'), 'quantity' => 150, 'price' => 0.80],
            ['item_name' => __('stock.fluoxetine'), 'quantity' => 170, 'price' => 1.00],
            ['item_name' => __('stock.albuterol'), 'quantity' => 110, 'price' => 0.90],
            ['item_name' => __('stock.cyclobenzaprine'), 'quantity' => 140, 'price' => 0.80],
            ['item_name' => __('stock.venlafaxine'), 'quantity' => 130, 'price' => 1.10],
            ['item_name' => __('stock.tamsulosin'), 'quantity' => 120, 'price' => 0.70],
            ['item_name' => __('stock.sildenafil'), 'quantity' => 110, 'price' => 1.20],
            ['item_name' => __('stock.pravastatin'), 'quantity' => 160, 'price' => 0.80],
            ['item_name' => __('stock.vitaminD'), 'quantity' => 140, 'price' => 0.50],
            ['item_name' => __('stock.diclofenac'), 'quantity' => 130, 'price' => 0.70],
            ['item_name' => __('stock.oxycodone'), 'quantity' => 90, 'price' => 1.50],
            ['item_name' => __('stock.loratadine'), 'quantity' => 180, 'price' => 0.60],
            ['item_name' => __('stock.finasteride'), 'quantity' => 110, 'price' => 1.00],
            ['item_name' => __('stock.metoprolol'), 'quantity' => 120, 'price' => 0.90],
            ['item_name' => __('stock.valacyclovir'), 'quantity' => 140, 'price' => 0.80],
            ['item_name' => __('stock.clindamycin'), 'quantity' => 160, 'price' => 0.70],
            ['item_name' => __('stock.famotidine'), 'quantity' => 170, 'price' => 0.60],
            ['item_name' => __('stock.fluconazole'), 'quantity' => 130, 'price' => 0.90],
            ['item_name' => __('stock.hydroxyzine'), 'quantity' => 110, 'price' => 0.80],
            ['item_name' => __('stock.lamotrigine'), 'quantity' => 120, 'price' => 1.00],
            ['item_name' => __('stock.mirtazapine'), 'quantity' => 140, 'price' => 0.90],
        ];

        foreach ($medicines as $medicine) {
            Stock::create($medicine);
        }
    }
}


