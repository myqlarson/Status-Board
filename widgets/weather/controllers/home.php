<?php
include BUNDLE_PATH.'weather/libraries/gweather.php';

class Weather_Home_Controller extends Controller {

	public $restful = true;

	public function get_index()
	{
		$size = 'small';
		$weather = $this->_get_weather();
		print_r($weather);
		$view = View::make('weather::'.$size)
			->with('weather', $weather);
		exit($view);
	}

	public function post_index()
	{
		$view_file = 'weather::'.Input::get('size', 'small');
		$weather = $this->_get_weather(Input::get('zip', '28056'));
		$view = View::make($view_file)
			->with('weather', $weather)
			->with('css', File::get(BUNDLE_PATH.'weather/weather.css'));
		exit($view);
	}

	private function _get_weather($zip)
	{
		$w = new googleWeather();
		$w->enable_cache = 0;
		$data = $w->get_weather_data($zip);
		$data['location'] = 'Charlotte';
		return $data;
	}
}