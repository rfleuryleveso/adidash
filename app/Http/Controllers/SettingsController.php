<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SettingsController extends Controller {
	/**
	 * Displays the settings page
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home() {
		return view('settings');
	}

}
