<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:255|unique:customers,phone',
            'email' => 'nullable|string|email|max:255|unique:customers,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        $customer = new Customer();
        $customer->full_name = $request->full_name;
        $customer->address = $request->address;
        $customer->father_name = $request->father_name;
        $customer->age = $request->age;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->updated_by = Auth::user()->name;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            //$request->image->move(public_path('assets/customers'), $imageName);
             $destinationPath = '/home/towhid/public_html/assets/customers';
            $request->image->move($destinationPath, $imageName); 

            $customer->image = 'assets/customers/' . $imageName;
        }

        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $transactions = $customer->transactions()->orderBy('id', 'desc')->get();
        return view('customers.show', compact('customer', 'transactions'));
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:255|unique:customers,phone,' . $id,
            'email' => 'nullable|string|email|max:255|unique:customers,email,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->full_name = $request->full_name;
        $customer->address = $request->address;
        $customer->father_name = $request->father_name;
        $customer->age = $request->age;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->updated_by = Auth::user()->name;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            //$request->image->move(public_path('assets/customers'), $imageName);
            $destinationPath = '/home/towhid/public_html/assets/customers';
            $request->image->move($destinationPath, $imageName); 

            $customer->image = 'assets/customers/' . $imageName;
        }

        $customer->save();

        return redirect()->route('customers.show', $id)->with('success', 'Customer updated successfully.');
    }
}
