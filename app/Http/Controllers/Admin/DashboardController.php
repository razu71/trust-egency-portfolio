<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Gallery;
use App\Model\People;
use App\Model\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard(){
        $data['people'] = People::count();
        $data['client'] = Client::count();
        $data['gallery'] = Gallery::count();
        $data['slider'] = Slider::count();
        return view('admin.dashboard',$data);
    }
}
