<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->create([
            'phone' => '650 995 7500',
            'phone_footer' => '(650) 995-7500',
            'office_hours' => '9am – 5pm Mon-Sun',
            'office_hours_footer' => 'Monday - Sunday 9:00 a.m. -5:00 p.m.',
            'email' => 'info@junkdeal.com',
            'about_footer' => 'Junk Deal is a family owned & operated, local San Francisco Bay Area full service junk removal company specializing in residential junk removal, business junk removal & commercial property junk removal services.',
            'location' => '3641 Haven Ave., Suite C, Menlo Park, CA 94025',
        ]);
    }
}
