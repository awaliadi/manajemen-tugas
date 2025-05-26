<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        try{
        $data = array (
            'title'             => 'Data User',
            'menuAdminUser'     => 'active',
            'user'              =>  User::orderBy('jabatan','asc')-> get(),
        );
        return view('admin/user/index',$data);
    }catch (\Exception $e) {
        echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
        return view('error.index');
    }
    }

    public function create(){
        try {
            $data = [
                'title'         => 'Tambah Data User',
                'menuAdminUser' => 'active',
            ];
            return view('admin/user/create', $data);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'nama'      => 'required',
                'email'     => 'required|unique:users,email',
                'jabatan'   => 'required',
                'password'  => 'required|confirmed|min:8',
            ]);

            $user = new User;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->jabatan = $request->jabatan;
            $user->password = Hash::make($request->password);
            $user->is_tugas = false;
            $user->save();

            return redirect()->route('user')->with('success', 'Data Berhasil Ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id){
        try {
            $data = [
                'title'         => 'Edit Data User',
                'menuAdminUser' => 'active',
                'user'          => User::findOrFail($id),
            ];
            return view('admin/user/edit', $data);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'nama'     => 'required',
                'email'    => 'required|unique:users,email,' . $id,
                'jabatan'  => 'required',
                'password' => 'nullable|confirmed|min:8',
            ]);

            $user = User::with('tugas')->findOrFail($id);
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->jabatan = $request->jabatan;

            if ($request->jabatan=='Admin') {
                $user->is_tugas = false;
                $user->tugas()->delete();
            }

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return redirect()->route('user')->with('success', 'Data Berhasil Di Edit');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('user')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function excel(){
        try {
            $filename = now()->format('d-m-Y_H.i.s');
            return Excel::download(new UserExport, 'DataUser_' . $filename . '.xlsx');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function pdf(){
        try {
            $filename = now()->format('d-m-Y_H.i.s');
            $data = [
                'user'    => User::get(),
                'tanggal' => now()->format('d-m-Y'),
                'jam'     => now()->format('H.i.s'),
            ];

            $pdf = Pdf::loadView('admin/user/pdf', $data);
            return $pdf->setPaper('a4', 'landscape')->stream('DataUser_' . $filename . '.pdf');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
