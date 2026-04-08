<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function index(Request $request){

        $admin = Auth::guard('admin')->user();

        // Query Dasar dengan Realasi
        $query = InputAspirasi::with('siswa', 'kategori', 'aspirasi');

        // Filter: Jika ada request filter
        if ($request->filled('tanggal')){
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $laporan = $query->latest()->get();
        $kategori_list = Kategori::all();
        return view('admin.dasboard', compact('laporan', 'kategori_list'));
    }

    public function updateStatus(Request $request, $id) {
        // Update tabel Aspirasi
        $aspirasi = Aspirasi::where('id_pelaporan', $id)->first();
        
        $aspirasi->update([
            'status' => $request->status, // 'Proses' atau 'Selesai'
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }
}