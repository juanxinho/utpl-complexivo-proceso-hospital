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
            ['item_code' => 'STK001', 'item_name' => __('stock.aspirin'), 'quantity' => 100, 'price' => 0.50],
            ['item_code' => 'STK002', 'item_name' => __('stock.ibuprofen'), 'quantity' => 150, 'price' => 0.80],
            ['item_code' => 'STK003', 'item_name' => __('stock.paracetamol'), 'quantity' => 200, 'price' => 0.60],
            ['item_code' => 'STK004', 'item_name' => __('stock.amoxicillin'), 'quantity' => 120, 'price' => 1.20],
            ['item_code' => 'STK005', 'item_name' => __('stock.metformin'), 'quantity' => 180, 'price' => 0.40],
            ['item_code' => 'STK006', 'item_name' => __('stock.atorvastatin'), 'quantity' => 130, 'price' => 0.90],
            ['item_code' => 'STK007', 'item_name' => __('stock.lisinopril'), 'quantity' => 110, 'price' => 0.70],
            ['item_code' => 'STK008', 'item_name' => __('stock.omeprazole'), 'quantity' => 140, 'price' => 0.80],
            ['item_code' => 'STK009', 'item_name' => __('stock.azithromycin'), 'quantity' => 90, 'price' => 1.00],
            ['item_code' => 'STK010', 'item_name' => __('stock.amlodipine'), 'quantity' => 100, 'price' => 0.60],
            ['item_code' => 'STK011', 'item_name' => __('stock.hydrochlorothiazide'), 'quantity' => 170, 'price' => 0.50],
            ['item_code' => 'STK012', 'item_name' => __('stock.simvastatin'), 'quantity' => 160, 'price' => 0.70],
            ['item_code' => 'STK013', 'item_name' => __('stock.citalopram'), 'quantity' => 140, 'price' => 0.90],
            ['item_code' => 'STK014', 'item_name' => __('stock.losartan'), 'quantity' => 150, 'price' => 0.80],
            ['item_code' => 'STK015', 'item_name' => __('stock.gabapentin'), 'quantity' => 130, 'price' => 1.10],
            ['item_code' => 'STK016', 'item_name' => __('stock.pantoprazole'), 'quantity' => 180, 'price' => 0.70],
            ['item_code' => 'STK017', 'item_name' => __('stock.prednisone'), 'quantity' => 100, 'price' => 0.60],
            ['item_code' => 'STK018', 'item_name' => __('stock.levothyroxine'), 'quantity' => 110, 'price' => 0.50],
            ['item_code' => 'STK019', 'item_name' => __('stock.clopidogrel'), 'quantity' => 130, 'price' => 0.90],
            ['item_code' => 'STK020', 'item_name' => __('stock.montelukast'), 'quantity' => 140, 'price' => 0.80],
            ['item_code' => 'STK021', 'item_name' => __('stock.sertraline'), 'quantity' => 150, 'price' => 1.00],
            ['item_code' => 'STK022', 'item_name' => __('stock.furosemide'), 'quantity' => 110, 'price' => 0.70],
            ['item_code' => 'STK023', 'item_name' => __('stock.zolpidem'), 'quantity' => 90, 'price' => 1.20],
            ['item_code' => 'STK024', 'item_name' => __('stock.tramadol'), 'quantity' => 100, 'price' => 1.00],
            ['item_code' => 'STK025', 'item_name' => __('stock.escitalopram'), 'quantity' => 160, 'price' => 1.10],
            ['item_code' => 'STK026', 'item_name' => __('stock.meloxicam'), 'quantity' => 130, 'price' => 0.80],
            ['item_code' => 'STK027', 'item_name' => __('stock.allopurinol'), 'quantity' => 140, 'price' => 0.90],
            ['item_code' => 'STK028', 'item_name' => __('stock.ciprofloxacin'), 'quantity' => 120, 'price' => 1.00],
            ['item_code' => 'STK029', 'item_name' => __('stock.doxycycline'), 'quantity' => 150, 'price' => 0.80],
            ['item_code' => 'STK030', 'item_name' => __('stock.fluoxetine'), 'quantity' => 170, 'price' => 1.00],
            ['item_code' => 'STK031', 'item_name' => __('stock.albuterol'), 'quantity' => 110, 'price' => 0.90],
            ['item_code' => 'STK032', 'item_name' => __('stock.cyclobenzaprine'), 'quantity' => 140, 'price' => 0.80],
            ['item_code' => 'STK033', 'item_name' => __('stock.venlafaxine'), 'quantity' => 130, 'price' => 1.10],
            ['item_code' => 'STK034', 'item_name' => __('stock.tamsulosin'), 'quantity' => 120, 'price' => 0.70],
            ['item_code' => 'STK035', 'item_name' => __('stock.sildenafil'), 'quantity' => 110, 'price' => 1.20],
            ['item_code' => 'STK036', 'item_name' => __('stock.pravastatin'), 'quantity' => 160, 'price' => 0.80],
            ['item_code' => 'STK037', 'item_name' => __('stock.vitaminD'), 'quantity' => 140, 'price' => 0.50],
            ['item_code' => 'STK038', 'item_name' => __('stock.diclofenac'), 'quantity' => 130, 'price' => 0.70],
            ['item_code' => 'STK039', 'item_name' => __('stock.oxycodone'), 'quantity' => 90, 'price' => 1.50],
            ['item_code' => 'STK040', 'item_name' => __('stock.loratadine'), 'quantity' => 180, 'price' => 0.60],
            ['item_code' => 'STK041', 'item_name' => __('stock.finasteride'), 'quantity' => 110, 'price' => 1.00],
            ['item_code' => 'STK042', 'item_name' => __('stock.metoprolol'), 'quantity' => 120, 'price' => 0.90],
            ['item_code' => 'STK043', 'item_name' => __('stock.valacyclovir'), 'quantity' => 140, 'price' => 0.80],
            ['item_code' => 'STK044', 'item_name' => __('stock.clindamycin'), 'quantity' => 160, 'price' => 0.70],
            ['item_code' => 'STK045', 'item_name' => __('stock.famotidine'), 'quantity' => 170, 'price' => 0.60],
            ['item_code' => 'STK046', 'item_name' => __('stock.fluconazole'), 'quantity' => 130, 'price' => 0.90],
            ['item_code' => 'STK047', 'item_name' => __('stock.hydroxyzine'), 'quantity' => 110, 'price' => 0.80],
            ['item_code' => 'STK048', 'item_name' => __('stock.lamotrigine'), 'quantity' => 120, 'price' => 1.00],
            ['item_code' => 'STK049', 'item_name' => __('stock.mirtazapine'), 'quantity' => 140, 'price' => 0.90],
        ];

        foreach ($medicines as $medicine) {
            Stock::create($medicine);
        }
    }
}


