<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeatherMail;
use App\User;

class WeatherController extends Controller
{
    public function currentWeather()
    {
        $city = DB::table('weathers')->get()->first();

        $client = new Client(['verify' => false]);
        try {
            $response = $client->request("Get",
                "https://api.openweathermap.org/data/2.5/weather?q=". $city->city ."&appid=" .
                env('WEATHER_API_KEY') . "&units=metric");

        } catch (RequestException $e) {
            abort(403, 'Sorry such city does not exist');
        }
        if ($response->getStatusCode() == 200) {
            $weather = json_decode($response->getBody(), true);
            $direction = $this->windDirection($weather['wind']['deg']);

            return view('weather.view', compact('weather', 'direction'));
        } else
            abort(403, 'Could not reach the weather server');
    }

    public function checkWind()
    {
        $weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=Kaunas&appid=" .env('WEATHER_API_KEY') . "&units=metric";
        $json = file_get_contents($weatherUrl);
        $weather = json_decode($json);
        $windSpeed = $weather->wind->speed;
        $tempSpeed = 14;

        $users = User::all();

        if ($windSpeed > 10 && $tempSpeed < 10)
        {
            foreach ($users as $user) {
                if($user->alertEmail != null)
                Mail::to($user->alertEmail)->send(new WeatherMail("greater"));
            }
            $tempSpeed = $windSpeed;
        }
        else if ($windSpeed < 10 && $tempSpeed > 10)
        {
            foreach ($users as $user) {
                if($user->alertEmail != null)
                Mail::to($user->alertEmail)->send(new WeatherMail("lower"));
            }
            $tempSpeed = $windSpeed;
        }
    }


    private function windDirection($degree)
    {
            $sectors = ['North','North East','East','South East','South','South West','West','North West'];
            $degree += 22.5;

            if ($degree < 0)
                $degree = 360 - abs($degree) % 360;
            else
                $degree = $degree % 360;

            $which = intval($degree / 45);
            return $sectors[$which];
    }

    public function create()
    {
        return view('weather.create');
    }


    public function update()
    {
        request()->validate([
           'email' => 'required'
        ]);
        User::where('id',auth()->user()->id)->update([
            'alertEmail' => request('email')
        ]);
        return redirect()->action('WeatherController@currentWeather');
    }

    public function selectCity()
    {
        $cities = DB::table('cities')->get();
        return view('weather.city', compact('cities'));
    }
}
