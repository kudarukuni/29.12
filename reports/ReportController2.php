<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController2 extends Controller{
    public function showApplicationReport(){
        return view('reports.applications');
    }
}
