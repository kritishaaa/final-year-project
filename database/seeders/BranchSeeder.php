<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Branch\Models\Branch;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            // =======================
            // KATHMANDU (10)
            // =======================
            ['name' => 'Kathmandu Main Branch', 'code' => 'KTM001', 'address' => 'Sundhara, Kathmandu', 'latitude' => 27.7033, 'longitude' => 85.3157],
            ['name' => 'New Baneshwor Branch', 'code' => 'KTM002', 'address' => 'New Baneshwor, Kathmandu', 'latitude' => 27.6892, 'longitude' => 85.3420],
            ['name' => 'Maharajgunj Branch', 'code' => 'KTM003', 'address' => 'Maharajgunj, Kathmandu', 'latitude' => 27.7390, 'longitude' => 85.3333],
            ['name' => 'Kalanki Branch', 'code' => 'KTM004', 'address' => 'Kalanki, Kathmandu', 'latitude' => 27.6930, 'longitude' => 85.2818],
            ['name' => 'Kalimati Branch', 'code' => 'KTM005', 'address' => 'Kalimati, Kathmandu', 'latitude' => 27.6975, 'longitude' => 85.2993],
            ['name' => 'Chabahil Branch', 'code' => 'KTM006', 'address' => 'Chabahil, Kathmandu', 'latitude' => 27.7175, 'longitude' => 85.3497],
            ['name' => 'Balaju Branch', 'code' => 'KTM007', 'address' => 'Balaju, Kathmandu', 'latitude' => 27.7341, 'longitude' => 85.2981],
            ['name' => 'Boudha Branch', 'code' => 'KTM008', 'address' => 'Boudha, Kathmandu', 'latitude' => 27.7204, 'longitude' => 85.3617],
            ['name' => 'Teku Branch', 'code' => 'KTM009', 'address' => 'Teku, Kathmandu', 'latitude' => 27.6952, 'longitude' => 85.3047],
            ['name' => 'Gongabu Branch', 'code' => 'KTM010', 'address' => 'Gongabu, Kathmandu', 'latitude' => 27.7375, 'longitude' => 85.3094],

            // =======================
            // LALITPUR (8)
            // =======================
            ['name' => 'Pulchowk Branch', 'code' => 'LTP001', 'address' => 'Pulchowk, Lalitpur', 'latitude' => 27.6739, 'longitude' => 85.3188],
            ['name' => 'Jawalakhel Branch', 'code' => 'LTP002', 'address' => 'Jawalakhel, Lalitpur', 'latitude' => 27.6763, 'longitude' => 85.3119],
            ['name' => 'Satdobato Branch', 'code' => 'LTP003', 'address' => 'Satdobato, Lalitpur', 'latitude' => 27.6560, 'longitude' => 85.3267],
            ['name' => 'Kumaripati Branch', 'code' => 'LTP004', 'address' => 'Kumaripati, Lalitpur', 'latitude' => 27.6679, 'longitude' => 85.3170],
            ['name' => 'Patan Dhoka Branch', 'code' => 'LTP005', 'address' => 'Patan Dhoka, Lalitpur', 'latitude' => 27.6785, 'longitude' => 85.3234],
            ['name' => 'Lagankhel Branch', 'code' => 'LTP006', 'address' => 'Lagankhel, Lalitpur', 'latitude' => 27.6672, 'longitude' => 85.3225],
            ['name' => 'Imadol Branch', 'code' => 'LTP007', 'address' => 'Imadol, Lalitpur', 'latitude' => 27.6641, 'longitude' => 85.3439],
            ['name' => 'Godawari Branch', 'code' => 'LTP008', 'address' => 'Godawari, Lalitpur', 'latitude' => 27.5929, 'longitude' => 85.3921],

            // =======================
            // BHAKTAPUR (7)
            // =======================
            ['name' => 'Bhaktapur Main Branch', 'code' => 'BKT001', 'address' => 'Durbar Square, Bhaktapur', 'latitude' => 27.6710, 'longitude' => 85.4298],
            ['name' => 'Suryabinayak Branch', 'code' => 'BKT002', 'address' => 'Suryabinayak, Bhaktapur', 'latitude' => 27.6675, 'longitude' => 85.4442],
            ['name' => 'Sallaghari Branch', 'code' => 'BKT003', 'address' => 'Sallaghari, Bhaktapur', 'latitude' => 27.6824, 'longitude' => 85.4121],
            ['name' => 'Thimi Branch', 'code' => 'BKT004', 'address' => 'Madhyapur Thimi, Bhaktapur', 'latitude' => 27.6817, 'longitude' => 85.3901],
            ['name' => 'Kausaltar Branch', 'code' => 'BKT005', 'address' => 'Kausaltar, Bhaktapur', 'latitude' => 27.6850, 'longitude' => 85.3765],
            ['name' => 'Balkot Branch', 'code' => 'BKT006', 'address' => 'Balkot, Bhaktapur', 'latitude' => 27.6651, 'longitude' => 85.4172],
            ['name' => 'Nala Branch', 'code' => 'BKT007', 'address' => 'Nala, Bhaktapur', 'latitude' => 27.6669, 'longitude' => 85.4844],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
