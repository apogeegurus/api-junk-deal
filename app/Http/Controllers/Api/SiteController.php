<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Submit;
use App\Models\Quote;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Testimonial;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SiteController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $settings = Setting::query()->first();
        return response()->json(['settings' => $settings]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexTestimonials()
    {
        $testimonials = Testimonial::query()
            ->select('name', 'description')
            ->get();
        return response()->json(['testimonials' => $testimonials]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexSlider()
    {
        $sliders = Slider::query()
            ->select('id', 'file_name')
            ->get();

        return response()->json(['sliders' => $sliders]);
    }

    /**
     * @param Submit $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getQuote(Submit $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'zip_code', 'date', 'description']);
        $data['date'] = Carbon::createFromTimeString($data['date'])->format('Y-m-d');

        try {
            $client = new Client();
            $providerKey = env('SMART_MOVING_PROVIDER_KEY');
            $response = $client->request("POST", "https://api.smartmoving.com/api/leads/from-provider/v2?providerKey=$providerKey", [
                'headers'  => [
                    'Content-Type' => 'application/json'
                ],
                'form_params' => [
                    'FullName' => $data['name'],
                    'PhoneNumber' => $data['phone'],
                    'Email' => $data['email'],
                    'DestinationZip' => $data['zip_code'],
                    'MoveDate' => Carbon::createFromFormat('Y-m-d', $data['date'])->format('Ymd'),
                    'Notes' => $data['description']
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $response = json_decode($response->getBody(), true);

            if($statusCode === 400)
                return response()->json(['message' => $response]);

            Quote::query()->create($data);
        } catch (\Exception $err) {
            Log::info($err->getMessage());
            return response()->json(['message' => 'Something wrong please try again.'], 400);
        }

        return response()->json(['success' => true], 204);
    }
}
