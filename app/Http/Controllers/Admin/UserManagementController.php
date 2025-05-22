<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Instruktur;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::all()->map(function ($admin) {
            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => 'admin',
            ];
        });

        $instrukturs = Instruktur::all()->map(function ($instruktur) {
            return [
                'id' => $instruktur->id,
                'name' => $instruktur->name,
                'email' => $instruktur->email,
                'role' => 'instructor',
            ];
        });

        $students = Student::all()->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'role' => 'student',
            ];
        });

        $users = $admins->merge($instrukturs)->merge($students);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins|unique:instrukturs|unique:students',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,instructor,student',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        switch ($request->role) {
            case 'admin':
                Admin::create($data);
                break;
            case 'instructor':
                Instruktur::create($data);
                break;
            case 'student':
                Student::create($data);
                break;
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($role, $id)
    {
        $user = $this->getUserByRole($role, $id);
        return view('admin.users.edit', compact('user', 'role'));
    }

    public function update(Request $request, $role, $id)
    {
        $user = $this->getUserByRole($role, $id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($role, $id)
    {
        $user = $this->getUserByRole($role, $id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    private function getUserByRole($role, $id)
    {
        switch ($role) {
            case 'admin':
                return Admin::findOrFail($id);
            case 'instructor':
                return Instruktur::findOrFail($id);
            case 'student':
                return Student::findOrFail($id);
            default:
                abort(404);
        }
    }
}