<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CustomerModel;


class AdminCustomerController extends Controller
{

    public function customerall(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::all(),
            'heading' => "ALl Customer List"
        ]);
    }
    public function customeractivelist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 2)->get(),
            'heading' => "Old Active Customer List"
        ]);
    }
    public function customerinactivelist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 3)->get(),
            'heading' => "Inactive Customer List"
        ]);
    }
    public function customernewlist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 1)->get(),
            'heading' => "New Request Customer List"
        ]);
    }
}
