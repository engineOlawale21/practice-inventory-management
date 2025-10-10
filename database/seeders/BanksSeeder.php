<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; // Import Carbon for efficient timestamp handling

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define a single timestamp for all records for consistency
        $now = Carbon::now();

        // Define the base bank data
        $banks = [
            ['name' => 'MPESA', 'short_name' => 'MPESA', 'sort_code' => '99999'],
            ['name' => 'KCB Bank', 'short_name' => 'KCB', 'sort_code' => '01100'],
            ['name' => 'Standard Chartered Bank', 'short_name' => 'STANCHART', 'sort_code' => '02000'],
            ['name' => 'ABSA Bank', 'short_name' => 'ABSA', 'sort_code' => '03000'],
            ['name' => 'Bank of India', 'short_name' => 'BOI', 'sort_code' => '05000'],
            ['name' => 'Bank of Baroda', 'short_name' => 'BARODA', 'sort_code' => '06000'],
            ['name' => 'NCBA Bank', 'short_name' => 'NCBA', 'sort_code' => '07000'],
            ['name' => 'Stima Sacco', 'short_name' => 'STIMA', 'sort_code' => '08000'],
            ['name' => 'Interswitch Bank', 'short_name' => 'INTERSWITCH', 'sort_code' => '09000'],
            ['name' => 'Prime Bank', 'short_name' => 'PRIME', 'sort_code' => '10000'],
            ['name' => 'Co-operative Bank', 'short_name' => 'CO-OP', 'sort_code' => '11000'],
            ['name' => 'National Bank', 'short_name' => 'NBK', 'sort_code' => '12000'],
            ['name' => 'Oriental Bank', 'short_name' => 'ORIENTAL', 'sort_code' => '14000'],
            ['name' => 'Citi Bank', 'short_name' => 'CITI', 'sort_code' => '16000'],
            ['name' => 'Habib Bank AG Zurich', 'short_name' => 'HABIB', 'sort_code' => '17000'],
            ['name' => 'Middle East Bank', 'short_name' => 'MIDDLEEAST', 'sort_code' => '18000'],
            ['name' => 'Bank of Africa', 'short_name' => 'BOA', 'sort_code' => '19000'],
            ['name' => 'Consolidated Bank', 'short_name' => 'CONSOLIDATED', 'sort_code' => '23000'],
            ['name' => 'Credit Bank', 'short_name' => 'CREDIT', 'sort_code' => '25000'],
            ['name' => 'Access Bank', 'short_name' => 'ACCESS', 'sort_code' => '26004'],
            ['name' => 'Chase Bank', 'short_name' => 'CHASE', 'sort_code' => '30000'],
            ['name' => 'Stanbic Bank', 'short_name' => 'STANBIC', 'sort_code' => '31000'],
            ['name' => 'ABC Bank', 'short_name' => 'ABC', 'sort_code' => '35000'],
            ['name' => 'Ecobank', 'short_name' => 'ECOBANK', 'sort_code' => '43000'],
            ['name' => 'Spire Bank', 'short_name' => 'SPIRE', 'sort_code' => '49000'],
            ['name' => 'Paramount Bank', 'short_name' => 'PARAMOUNT', 'sort_code' => '50000'],
            ['name' => 'Jamii Bora Bank', 'short_name' => 'JAMIIBORA', 'sort_code' => '51000'],
            ['name' => 'Guaranty Trust Bank', 'short_name' => 'GT', 'sort_code' => '53000'],
            ['name' => 'Victoria Bank', 'short_name' => 'VICTORIA', 'sort_code' => '54000'],
            ['name' => 'Guardian Bank', 'short_name' => 'GUARDIAN', 'sort_code' => '55000'],
            ['name' => 'I&M Bank', 'short_name' => 'IANDM', 'sort_code' => '57000'],
            ['name' => 'Development Bank', 'short_name' => 'DEVELOPMENT', 'sort_code' => '59000'],
            ['name' => 'Fidelity Bank', 'short_name' => 'FIDELITY', 'sort_code' => '60000'],
            ['name' => 'Housing Finance', 'short_name' => 'HFC', 'sort_code' => '61000'],
            ['name' => 'Kenya Post Office Savings Bank', 'short_name' => 'POSTBANK', 'sort_code' => '62309'],
            ['name' => 'Diamond Trust Bank', 'short_name' => 'DTB', 'sort_code' => '63000'],
            ['name' => 'Mayfair Bank', 'short_name' => 'MAYFAIR', 'sort_code' => '65000'],
            ['name' => 'Sidian Bank', 'short_name' => 'SIDIAN', 'sort_code' => '66000'],
            ['name' => 'Equity Bank', 'short_name' => 'EQUITY', 'sort_code' => '68000'],
            ['name' => 'Family Bank', 'short_name' => 'FAMILY', 'sort_code' => '70000'],
            ['name' => 'Gulf African Bank', 'short_name' => 'GULF', 'sort_code' => '72000'],
            ['name' => 'First Community Bank', 'short_name' => 'FCB', 'sort_code' => '74000'],
            ['name' => 'DIB Bank', 'short_name' => 'DIB', 'sort_code' => '75000'],
            ['name' => 'UBA Bank', 'short_name' => 'UBA', 'sort_code' => '76000'],
            ['name' => 'Faulu Bank', 'short_name' => 'FAULU', 'sort_code' => '79000'],
            ['name' => 'KWFT Bank', 'short_name' => 'KWFT', 'sort_code' => '78000'],
        ];

        // Map the banks array to include created_at and updated_at timestamps
        $banksWithTimestamps = array_map(function ($bank) use ($now) {
            $bank['created_at'] = $now;
            $bank['updated_at'] = $now;
            return $bank;
        }, $banks);

        // Perform a single bulk insertion
        DB::table('banks')->insert($banksWithTimestamps);
    }
}
