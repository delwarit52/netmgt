<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use App\Models\InvioceModel;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminCustomerController extends Controller
{

    public function customerall(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status','!=', 0)->get(),
            'heading' => "ALl Customer List"
        ]);
    }
    public function customeractivelist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 1)->get(),
            'heading' => "Old Active Customer List"
        ]);
    }
    public function customerinactivelist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 2)->get(),
            'heading' => "Inactive Customer List"
        ]);
    }
    public function customernewlist(){
        return view('pages.admin.customerlist',[
            'customers' => CustomerModel::where('status', 0)->get(),
            'heading' => "New Request Customer List"
        ]);
    }

    public function customerregister(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'net_id' =>['required', 'unique:users', 'max:255'],
            'password' => 'required',
        ]);
        $customer = CustomerModel::where('id', $request->id)->first();
        $package = PackageModel::where('id', $customer->package_id)->first();

        InvioceModel::create([
            'invoice_no' => "ASF-" . $customer->id,
            'package_title' => $package->package_title,
            'package_price' => $package->package_price,
            'created_by' => Auth::id(),
            'cust_id' => $request->id,
        ]);

        $user_id = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'net_id' => $request->net_id,
            'password' => Hash::make($request->password),
        ]);

        CustomerModel::where('id' , $request->id)->update([
            'active_date' => Carbon::now(),
            'user_id' => $user_id->id,
            'status' => 1,
        ]);

        return redirect()->route('customer.activelist')->with('succsess', 'add successfully');
    }

    public function customeractive($id)
    {
        CustomerModel::find($id)->update([
            'status' => 2,
        ]);
        InvioceModel::where('cust_id', $id)->update([
            'status' => 0,
        ]);
        return back()->with('succsess', 'add successfully');
    }

    public function customerinactive($id)
    {
        CustomerModel::where('id',$id)->update([
            'status' => 1,
        ]);
        InvioceModel::where('cust_id', $id)->update([
            'status' => 1,
        ]);
        return back()->with('succsess', 'add successfully');
    }

    public function customerdelete($id)
    {
        $customer = CustomerModel::find($id);

        if ($customer->user_id) {
            User::where('email', $customer->user_id)->delete();
        }
        $customer->delete();

        return back()->with('succsess', 'add successfully');
    }

}
