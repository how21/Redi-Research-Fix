<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['full_name' => 'Partnership For Economic Growth', 'short_name' => 'PEG'],
            ['full_name' => 'The Asia Foundation', 'short_name' => 'TAF'],
            ['full_name' => 'Development Alternative Inc', 'short_name' => 'DAI'],
            ['full_name' => 'Bappeda Tuban', 'short_name' => 'Bappeda Tuban'],
            ['full_name' => 'European Community', 'short_name' => 'EC'],
            ['full_name' => 'EDAW', 'short_name' => 'EDAW'],
            ['full_name' => 'RTI - USAID', 'short_name' => 'RTI'],
            ['full_name' => 'Bank Indonesia', 'short_name' => 'BI'],
            ['full_name' => 'GTZ Profi - BI', 'short_name' => 'GTZ Profi'],
            ['full_name' => 'The Habibie Centre', 'short_name' => 'THC'],
            ['full_name' => 'GTZ Profi', 'short_name' => 'GTZ Profi'],
            ['full_name' => 'GTZ', 'short_name' => 'GTZ'],
            ['full_name' => 'Bappeko Surabaya', 'short_name' => 'Bappeko'],
            ['full_name' => 'SENADA - USAID', 'short_name' => 'SENADA'],
            ['full_name' => 'PEMKAB JOMBANG', 'short_name' => 'Pemkab Jombang'],
            ['full_name' => 'The World Bank', 'short_name' => 'WB'],
            ['full_name' => 'BI', 'short_name' => 'BI'],
            ['full_name' => 'ACER', 'short_name' => 'ACER'],
            ['full_name' => 'ANTARA', 'short_name' => 'ANTARA'],
            ['full_name' => 'SHELL', 'short_name' => 'SHELL'],
            ['full_name' => 'BI Surabaya', 'short_name' => 'BI Surabaya'],
            ['full_name' => 'ILO - WB', 'short_name' => 'ILO - WB'],
            ['full_name' => 'ILO', 'short_name' => 'ILO'],
            ['full_name' => 'IFC', 'short_name' => 'IFC'],
            ['full_name' => 'Harvard Business School', 'short_name' => 'HBS'],
            ['full_name' => 'IFC - TRPC', 'short_name' => 'IFC - TRPC'],
            ['full_name' => 'MSME Nigeria', 'short_name' => 'MSME Nigeria'],
            ['full_name' => 'Regionomika', 'short_name' => 'Regionomika'],
            ['full_name' => 'Indonesia Magnificence of Zakat', 'short_name' => 'IMZ'],
            ['full_name' => 'PT. BRI (Persero) Tbk', 'short_name' => 'BRI'],
            ['full_name' => 'Bank Prima Master', 'short_name' => 'Bank Prima'],
            ['full_name' => 'Bank Indonesia (BI) Mataram', 'short_name' => 'BI Mataram'],
            ['full_name' => 'BI Jakarta', 'short_name' => 'BI Jakarta'],
            ['full_name' => 'SEADI', 'short_name' => 'SEADI'],
            ['full_name' => 'SEADI - UNAIR', 'short_name' => 'SEADI UNAIR'],
            ['full_name' => 'BI Jawa Timur', 'short_name' => 'BI Jatim'],
            ['full_name' => 'BI Mataram', 'short_name' => 'BI Mataram'],
            ['full_name' => 'European Commission', 'short_name' => 'EC'],
            ['full_name' => 'Microsave', 'short_name' => 'Microsave'],
            ['full_name' => 'SEADI - PWA', 'short_name' => 'SEADI PWA'],
            ['full_name' => 'GRM', 'short_name' => 'GRM'],
            ['full_name' => 'TIA - ADB', 'short_name' => 'TIA ADB'],
            ['full_name' => 'BI Kediri', 'short_name' => 'BI Kediri'],
            ['full_name' => 'TRPC', 'short_name' => 'TRPC'],
            ['full_name' => 'JBS International', 'short_name' => 'JBS'],
            ['full_name' => 'University Birmingham', 'short_name' => 'UB'],
            ['full_name' => 'Kementrian Perekonomian', 'short_name' => 'Kemenko'],
            ['full_name' => 'BI Ambon', 'short_name' => 'BI Ambon'],
            ['full_name' => 'PT Palladium Internasional Indonesia', 'short_name' => 'Palladium'],
            ['full_name' => 'BI Jember', 'short_name' => 'BI Jember'],
            ['full_name' => 'USAID - Mitra Kunci', 'short_name' => 'USAID MK'],
            ['full_name' => 'Bank Bengkulu', 'short_name' => 'Bank Bengkulu'],
            ['full_name' => 'The World Bank Group', 'short_name' => 'WB Group'],
            ['full_name' => 'FHI 360', 'short_name' => 'FHI 360'],
            ['full_name' => 'YCP', 'short_name' => 'YCP'],
            ['full_name' => 'Yayasan Care Peduli', 'short_name' => 'YCP'],
            ['full_name' => 'A2F Consulting', 'short_name' => 'A2F'],
            ['full_name' => 'FHI360 - MADANI', 'short_name' => 'FHI MADANI'],
            ['full_name' => 'MSC Global Consulting PTE LTD', 'short_name' => 'MSC Global'],
            ['full_name' => 'JPAL - LPEM FEB UI', 'short_name' => 'JPAL LPEM'],
            ['full_name' => 'KOMIDA', 'short_name' => 'KOMIDA'],
            ['full_name' => 'BFA Global', 'short_name' => 'BFA Global'],
            ['full_name' => 'Prospera', 'short_name' => 'Prospera'],
        ];

        // Insert data ke dalam tabel `clients`
        DB::table('clients')->insert($clients);
    }
}
