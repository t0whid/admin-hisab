<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest('id')->get();

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
        ]);

        $customer = new Customer();
        $customer->full_name = $request->full_name;
        $customer->address = $request->address;
        $customer->father_name = $request->father_name;
        $customer->age = $request->age;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->updated_by = Auth::user()->name ?? 'System';

        if ($request->hasFile('image')) {
            $customer->image = $this->uploadCustomerImage($request->file('image'));
        }

        $customer->save();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $transactions = $customer->transactions()
            ->orderBy('id', 'desc')
            ->get();

        return view('customers.show', compact('customer', 'transactions'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0',
            'phone' => 'nullable|string|max:255|unique:customers,phone,' . $customer->id,
            'email' => 'nullable|string|email|max:255|unique:customers,email,' . $customer->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
        ]);

        $customer->full_name = $request->full_name;
        $customer->address = $request->address;
        $customer->father_name = $request->father_name;
        $customer->age = $request->age;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->updated_by = Auth::user()->name ?? 'System';

        if ($request->hasFile('image')) {
            $oldImage = $customer->image;

            $customer->image = $this->uploadCustomerImage($request->file('image'));

            $this->deleteCustomerImage($oldImage);
        }

        $customer->save();

        return redirect()
            ->route('customers.show', $customer->id)
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Delete Rule
        |--------------------------------------------------------------------------
        | Customer delete korte hole customer balance/amount 0 hote hobe.
        */
        if (abs((float) ($customer->amount ?? 0)) > 0.00001) {
            return redirect()
                ->back()
                ->with('error', 'Customer delete kora jabe na. Customer amount 0 hote hobe.');
        }

        DB::transaction(function () use ($customer) {
            $oldImage = $customer->image;

            /*
             * Customer delete korle tar transaction history o delete hobe.
             * Jodi apni transaction history rakhte chan, tahole ei line comment kore diben.
             */
            $customer->transactions()->delete();

            $customer->delete();

            $this->deleteCustomerImage($oldImage);
        });

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    private function uploadCustomerImage($image): string
    {
        $destinationPath = public_path('assets/customers');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move($destinationPath, $imageName);

        return 'assets/customers/' . $imageName;
    }

    private function deleteCustomerImage(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        if ($imagePath === 'assets/customers/user.png') {
            return;
        }

        $fullPath = public_path($imagePath);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}