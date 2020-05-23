<?php

namespace App\Console\Commands;

use App\Models\Location;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PopulateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populating Weather by cities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locations = $this->getLocations();
        $client = new Client();
        $APPKEY = config('app.openweather_api_key');

        foreach ($locations as $location) {
            $url = "https://api.openweathermap.org/data/2.5/weather?units=imperial&appid={$APPKEY}";
            $lat = $location->lat;
            $lon = $location->lon;

            if(empty($lat) || empty($lon))
                continue;

            $url = $url. "&lat=$lat&lon=$lon";
            $request = $client->get($url);
            $data = json_decode($request->getBody(), true);

            if(!empty($data) && !empty($data['weather'])) {
                $weather = $data['weather'][0] ?? [];

                if(!empty($weather)) {
                    $location->update(['weather_icon' => $weather['icon'] ?? null, 'weather' => round($data['main']['temp']) ?? null]);
                }
            }
        }
    }


    private function getLocations()
    {
        $locations = Location::query()
            ->select('id', 'city', 'lat', 'lon')
            ->get();

        return $locations;
    }
}
