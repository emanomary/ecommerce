<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.vendors.index',compact('vendors'));
    }

    /**
     * create vendor
     */
    public function create()
    {

    }

    /**
     * store vendors
     */
    public function store(Request $request)
    {

    }

    /**
     * store vendors
     */
    public function edit($id)
    {

    }

    /**
     * store vendors
     */
    public function update($id,Request $request)
    {

    }


}
