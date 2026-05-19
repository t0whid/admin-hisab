<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 1)
            ->latest('id')
            ->get();

        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'nullable|string|max:255|unique:users,user_name',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:30|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
            'status' => 'nullable|boolean',
        ]);

        $admin = new User();
        $admin->user_name = $request->user_name;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password;
        $admin->role = 1;
        $admin->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $admin->image = $this->uploadAdminImage($request->file('image'));
        }

        $admin->save();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin created successfully.');
    }

    public function edit(User $admin)
    {
        abort_if((int) $admin->role !== 1, 404);

        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        abort_if((int) $admin->role !== 1, 404);

        $request->validate([
            'user_name' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'user_name')->ignore($admin->id),
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($admin->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048',
            'status' => 'nullable|boolean',
        ]);

        $admin->user_name = $request->user_name;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role = 1;
        $admin->status = $request->has('status') ? 1 : 0;

        if ($request->filled('password')) {
            $admin->password = $request->password;
        }

        if ($request->hasFile('image')) {
            $oldImage = $admin->image;

            $admin->image = $this->uploadAdminImage($request->file('image'));

            $this->deleteAdminImage($oldImage);
        }

        $admin->save();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin updated successfully.');
    }

    public function destroy(User $admin)
    {
        abort_if((int) $admin->role !== 1, 404);

        if (auth()->id() === $admin->id) {
            return redirect()
                ->back()
                ->with('error', 'You cannot delete your own account.');
        }

        $oldImage = $admin->image;

        $admin->delete();

        $this->deleteAdminImage($oldImage);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully.');
    }

    private function uploadAdminImage($image): string
    {
        $destinationPath = public_path('assets/users');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move($destinationPath, $imageName);

        return 'assets/users/' . $imageName;
    }

    private function deleteAdminImage(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        if ($imagePath === 'assets/users/user.png') {
            return;
        }

        $fullPath = public_path($imagePath);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
}