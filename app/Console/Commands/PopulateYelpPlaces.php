<?php

namespace App\Console\Commands;

use App\Models\Location;
use App\Models\YelpPlace;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PopulateYelpPlaces extends Command
{
    protected $categories = ["coffee", "coffeeteasupplies", "coffeeroasteries", "restaurants"];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:yelp-places';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populating yelp places';

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
        $locations = Location::query()
            ->select("id", "city")
            ->get();

        foreach ($locations as $location) {
            $places = $this->getYelpBusinesses($location->city)["businesses"] ?? [];

            if(!empty($places)) {
                YelpPlace::query()->where("location_id", '=', $location->id)->delete();

                foreach ($places as $place) {
                    YelpPlace::query()->create([
                        "img" => $place["image_url"] ?? null,
                        "rating" => $place["rating"] ?? null,
                        "address" => $place["location"]["display_address"][0] ?? null,
                        "name" => $place["name"] ?? null,
                        "url" => $place["url"] ?? null,
                        "location_id" => $location->id
                    ]);
                }
            }
        }
    }


    /**
     * @param $location
     */
    private function getYelpBusinesses($location)
    {
        $API_KEY =  config("app.yelp_api_key");
        $client = new Client();
        $request = $client->get("https://api.yelp.com/v3/businesses/search", [
            "headers" => [
                "Authorization" => "Bearer $API_KEY"
            ],
            "query" => [
                "location" => $location,
                "categories" => implode($this->categories),
                "limit" => 12
            ]
        ]);

        return json_decode($request->getBody(), true);
    }
}
