<?php

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


function customer_package($id)
{
    // return $id;
    return App\Models\PackageModel::where('id', $id)->first();
}



