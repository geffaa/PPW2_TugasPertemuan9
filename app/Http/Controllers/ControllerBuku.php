<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Buku;  

class ControllerBuku extends Controller
{


    
    public function index(){
        // $data_buku = Buku::all();
        // $no = 0;
        // $total_harga = DB::table('buku')->sum('harga');
        // $jumlah_buku = $data_buku->count();
        // return view('buku.index', compact('data_buku', 'total_harga', 'no', 'jumlah_buku'));

        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id','desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku', 'no', 'total_harga','jumlah_buku'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $batas = 5;
        
        $data_buku = Buku::where('judul', 'like', '%' . $search . '%')
            ->orWhere('penulis', 'like', '%' . $search . '%')
            ->orWhere('harga', 'like', '%' . $search . '%')
            ->orWhere('tgl_terbit', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate($batas);

        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = Buku::sum('harga');
        $jumlah_buku = $data_buku->count();

        return view('buku.index', compact('data_buku', 'no', 'total_harga', 'jumlah_buku'));
    }

    public function create() {
        return view('buku.create');
    }

    public function store(Request $request) {
        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/buku');
    }

    public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
    }

    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id) {
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/buku');
    }
}
