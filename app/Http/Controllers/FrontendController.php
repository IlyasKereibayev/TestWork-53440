<?php
/**
 * Created by PhpStorm.
 * User: Ilyas
 * Date: 1/30/2021
 * Time: 7:52 PM
 */

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function app()
    {
        return view('app');
    }
}
