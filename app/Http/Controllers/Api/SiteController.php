<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Submit;
use App\Mail\ContactMail;
use App\Mail\ContactSubmitMail;
use App\Mail\Quote\SubmitAdminEmail;
use App\Mail\Quote\SubmitEmail;
use App\Mail\ReplyMail;
use App\Models\About;
use App\Models\Contact;
use App\Models\HomePage;
use App\Models\Quote;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Specialize;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Video;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            ->select('name', 'description', 'rating')
            ->get();
        return response()->json(['testimonials' => $testimonials]);
    }

    public function indexVideos()
    {
        $videos = Video::query()
            ->select('title', 'description', 'video_url', 'is_mobile')
            ->get();
        return response()->json(['videos' => $videos]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexSlider()
    {
        $sliders = Slider::query()
            ->select('id', 'file_name')
            ->orderBy('order', 'ASC')
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
//            $client = new Client();
//            $providerKey = env('SMART_MOVING_PROVIDER_KEY');
//            $response = $client->request("POST", "https://api.smartmoving.com/api/leads/from-provider/v2?providerKey=$providerKey", [
//                'headers'  => [
//                    'Content-Type' => 'application/json'
//                ],
//                'form_params' => [
//                    'FullName' => $data['name'],
//                    'PhoneNumber' => $data['phone'],
//                    'Email' => $data['email'],
//                    'DestinationZip' => $data['zip_code'],
//                    'MoveDate' => Carbon::createFromFormat('Y-m-d', $data['date'])->format('Ymd'),
//                    'Notes' => $data['description']
//                ]
//            ]);
//
//            $statusCode = $response->getStatusCode();
//            $response = json_decode($response->getBody(), true);
//
//            if($statusCode === 400)
//                return response()->json(['message' => $response]);

            $quote = Quote::query()->create($data);
            Mail::to($data['email'])
                ->queue(new SubmitEmail($quote));
            Mail::to(config("app.admin_email"))
                ->queue(new SubmitAdminEmail($quote));
        } catch (\Exception $err) {
            Log::info($err->getMessage());
            return response()->json(['message' => 'Something wrong please try again.'], 400);
        }

        return response()->json(['success' => true], 204);
    }


    /**
     * @param \App\Http\Requests\Contact\Submit $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contact(\App\Http\Requests\Contact\Submit $request)
    {
        $data = $request->only(['name', 'email', 'subject', 'message']);
        $contact = Contact::query()->create($data);

        Mail::to(config("app.admin_email"))
            ->queue(new ContactMail($contact));
        Mail::to($data['email'])
            ->queue(new ContactSubmitMail($contact));

        return response()->json(['success' => true], 204);
    }


    public function indexAbout()
    {
        return response()->json(['about' => About::query()->first(), 'members' => Team::query()->get()]);
    }

    public function indexSpecializes()
    {
        return response()->json(['specializes' => Specialize::query()->select('name')->orderBy("order", 'ASC')->get()->map(function ($item) { return ["label" => $item->name]; })]);
    }


    public function indexHomePage()
    {
        return response()->json(['home' => HomePage::query()->first()]);
    }
}
