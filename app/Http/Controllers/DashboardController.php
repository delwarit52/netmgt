<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\InvioceModel;
use App\Models\PackageModel;
use Illuminate\Http\Request;
use App\Models\CustomerModel;

class DashboardController extends Controller
{
    
    
    public function index()
    {
        return view('dashboard', [
            'customers' => CustomerModel::count(),
            'packages' => PackageModel::count(),
            'active_customers' => CustomerModel::where('status', 2)->count(),
            'inactive_customers' => CustomerModel::where('status', '!=', 2)->count(),
            'total_incomes' => InvioceModel::sum('package_price'),
            'total_cost' => ExpenseModel::sum('amount'),
            'invoices' => InvioceModel::count(),
        ]);
    }

    public function filterdate(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $dashboard_data = [
            'customers' => CustomerModel::whereBetween('created_at', [$start_date, $end_date])->count(),
            'packages' => PackageModel::whereBetween('created_at', [$start_date, $end_date])->count(),
            'active_customers' => CustomerModel::where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count(),
            'inactive_customers' => CustomerModel::where('status', '!=', 2)->whereBetween('created_at', [$start_date, $end_date])->count(),
            'invoices' => InvioceModel::whereBetween('created_at', [$start_date, $end_date])->count(),
            'total_incomes' => InvioceModel::whereBetween('created_at', [$start_date, $end_date])->sum('package_price'),
            'total_cost' => ExpenseModel::whereBetween('created_at', [$start_date, $end_date])->sum('amount'),
        ];
        return $dashboard_data;
    }
}
