<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekomendasiUser;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class RekomendasiController extends Controller
{
    // =========================
    // TAMPILKAN FORM
    // =========================
    public function index()
    {
        session()->forget(['tidak_suka', 'input_user']);
        return view('rekomendasi');
    }

    // =========================
    // HITUNG REKOMENDASI AWAL
    // =========================


public function hitung(Request $request)
{
    // =========================
    // VALIDASI USIA 4–18 TAHUN
    // =========================
    $request->validate(
        [   
            'nama'          => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:pria,wanita',
            'usia'          => 'required|integer|min:4|max:18',
            'berat'         => 'required|numeric|min:1',
            'tinggi'        => 'required|numeric|min:50',
        ],
        [
            'usia.min' => 'Usia minimal anak sekolah adalah 4 tahun',
            'usia.max' => 'Usia maksimal anak sekolah adalah 18 tahun',
        ]
    );
    $input = $request->all();
    $jenis_kelamin = $input['jenis_kelamin'];
    $usia  = $input['usia'];
    $berat = $input['berat'];
    $tinggi = $input['tinggi'];

    // =========================
    // HITUNG BMR
    // =========================
    if ($jenis_kelamin === 'pria') {
        $bmr = 66 + (13.7 * $berat) + (5 * $tinggi) - (6.8 * $usia);
    } else {
        $bmr = 655 + (9.6 * $berat) + (1.8 * $tinggi) - (4.7 * $usia);
    }

    // =========================
    // TARGET HARIAN
    // =========================
    $kalori_harian  = $bmr * 1.55;
    $protein_harian = ($kalori_harian * 0.15) / 4;
    $lemak_harian   = ($kalori_harian * 0.25) / 9;
    $karbo_harian   = ($kalori_harian * 0.60) / 4;
    $serat_harian   = 25;

    // =========================
    // TARGET PER PORSI
    // =========================
    $energi_target  = $kalori_harian / 3;
    $protein_target = $protein_harian / 3;
    $lemak_target   = $lemak_harian / 3;
    $karbo_target   = $karbo_harian / 3;
    $serat_target   = $serat_harian / 3;

    // =========================
    // KONDISI AKTUAL
    // =========================
    $aktual = [
        'energi'  => $berat * 30,
        'protein' => $berat * 1,
        'lemak'   => $berat * 0.8,
        'karbo'   => $berat * 4,
        'serat'   => 15,
    ];

    // =========================
    // KEKURANGAN
    // =========================
    $kurang = [
        'energi'  => max(0, $energi_target - $aktual['energi']),
        'protein' => max(0, $protein_target - $aktual['protein']),
        'lemak'   => max(0, $lemak_target - $aktual['lemak']),
        'karbo'   => max(0, $karbo_target - $aktual['karbo']),
        'serat'   => max(0, $serat_target - $aktual['serat']),
    ];

    // =========================
    // AMBIL MENU
    // =========================
    $kategoriList = ['Protein', 'Sayur', 'Buah', 'Snack', 'Karbohidrat'];
    $rekomendasi = collect();

    foreach ($kategoriList as $kategori) {
        $menu = $this->ambilMenu(
            $kategori,
            $energi_target,
            $protein_target,
            $lemak_target,
            $karbo_target,
            $serat_target
        );

         if ($menu) {
            $rekomendasi->push($menu);

            // =========================
            // 🔥 SIMPAN KE DATABASE
            // =========================
            RekomendasiUser::create([
                'user_id'        => Auth::id(),
                'nama'           => $input['nama'], // ✅ PENTING
                'kategori'       => $kategori,
                'data_bahan_id'  => $menu->id,
                'tanggal'        => Carbon::now()->toDateString(),
            ]);
         }
    }
    session(['input_user' => $input]);
    session([
    'rekomendasi_lama' => $rekomendasi
]);

    return view('rekomendasi', compact(
        'bmr',
        'kalori_harian',
        'protein_harian',
        'lemak_harian',
        'karbo_harian',
        'serat_harian',
        'energi_target',
        'protein_target',
        'lemak_target',
        'karbo_target',
        'serat_target',
        'aktual',
        'kurang',
        'rekomendasi',
        'input'
    ));
}



    // =========================
    // GANTI MENU TIDAK DISUKAI
    // =========================

 public function tolak(Request $request)
{
    $input = session('input_user');
    $rekomendasi_lama = session('rekomendasi_lama', []);

    if (!$input) {
        $input = $request->only(['jenis_kelamin', 'usia', 'berat', 'tinggi']);
        session(['input_user' => $input]);
    }

    if (!$input || empty($input['berat'])) {
        return redirect('/rekomendasi')
            ->with('error', 'Silakan hitung terlebih dahulu.');
    }


    // =========================
    // MENU YANG DICENTANG
    // =========================
    $tidak_suka_baru = $request->input('tidak_suka', []);
    $tidak_suka_lama = session('tidak_suka', []);
    $tidak_suka_total = array_unique(array_merge($tidak_suka_lama, $tidak_suka_baru));

    session(['tidak_suka' => $tidak_suka_total]);

    // =========================
    // HITUNG ULANG KEBUTUHAN
    // =========================
    $berat = $input['berat'];
    $usia = $input['usia'];
    $tinggi = $input['tinggi'];
    $jenis_kelamin = $input['jenis_kelamin'];

    if ($jenis_kelamin === 'pria') {
        $bmr = 66 + (13.7 * $berat) + (5 * $tinggi) - (6.8 * $usia);
    } else {
        $bmr = 655 + (9.6 * $berat) + (1.8 * $tinggi) - (4.7 * $usia);
    }

    $kalori_harian  = $bmr * 1.55;
    $protein_harian = ($kalori_harian * 0.15) / 4;
    $lemak_harian   = ($kalori_harian * 0.25) / 9;
    $karbo_harian   = ($kalori_harian * 0.60) / 4;
    $serat_harian   = 25;

    $energi_target  = $kalori_harian / 3;
    $protein_target = $protein_harian / 3;
    $lemak_target   = $lemak_harian / 3;
    $karbo_target   = $karbo_harian / 3;
    $serat_target   = $serat_harian / 3;

    $aktual = [
        'energi'  => $berat * 30,
        'protein' => $berat * 1,
        'lemak'   => $berat * 0.8,
        'karbo'   => $berat * 4,
        'serat'   => 15,
    ];

    // =========================
    // LOGIKA INTI (INI FIX BUG)
    // =========================
   $rekomendasi_baru = collect();

foreach ($rekomendasi_lama as $menu_lama) {

    if (in_array($menu_lama->id, $tidak_suka_baru)) {

        $blacklist = array_merge($tidak_suka_total, [$menu_lama->id]);

        $menu_baru = $this->ambilMenu(
            $menu_lama->kategori,
            $energi_target,
            $protein_target,
            $lemak_target,
            $karbo_target,
            $serat_target,
            $blacklist
        );

        // 🔒 FALLBACK
        $rekomendasi_baru->push($menu_baru ?? $menu_lama);

    } else {
        $rekomendasi_baru->push($menu_lama);
    }
}

    // UPDATE SESSION
    session(['rekomendasi_lama' => $rekomendasi_baru]);

    // =========================
    // SIMPAN RIWAYAT FINAL
    // =========================
    if (Auth::check()) {

    // HAPUS RIWAYAT HARI INI
    RekomendasiUser::where('user_id', Auth::id())
        ->where('nama', $input['nama'])
        ->whereDate('tanggal', Carbon::now()->toDateString())
        ->delete();

    // SIMPAN HASIL BARU (LENGKAP)
    foreach ($rekomendasi_baru as $menu) {
        RekomendasiUser::create([
            'user_id'        => Auth::id(),
            'nama'           => $input['nama'],
            'kategori'       => $menu->kategori,
            'data_bahan_id'  => $menu->id,
            'tanggal'        => Carbon::now()->toDateString(),

            // 🔥 WAJIB TAMBAH INI
            'usia'           => $input['usia'],
            'berat'          => $input['berat'],
            'tinggi'         => $input['tinggi'],
            'jenis_kelamin'  => $input['jenis_kelamin'],
        ]);
    }
}

    return view('rekomendasi', [
        'bmr' => $bmr,
        'kalori_harian' => $kalori_harian,
        'protein_harian' => $protein_harian,
        'lemak_harian' => $lemak_harian,
        'karbo_harian' => $karbo_harian,
        'serat_harian' => $serat_harian,
        'aktual' => $aktual,
        'rekomendasi' => $rekomendasi_baru,
        'input' => $input
    ]);
}




    // ====================================================
    // FUNGSI AMBIL MENU (AMAN + ADA FALLBACK)
    // ====================================================
    private function ambilMenu(
    $kategori,
    $energi_target,
    $protein_target,
    $lemak_target,
    $karbo_target,
    $serat_target,
    $tidak_suka = []
) {
    // =========================
    // 1. AMBIL KANDIDAT BESAR
    // =========================
    $kandidat = DB::table('data_bahan')
        ->where('kategori', $kategori)
        ->when(!empty($tidak_suka), function ($q) use ($tidak_suka) {
            $q->whereNotIn('id', $tidak_suka);
        })
        // ❌ JANGAN AMBIL MENU KEMARIN
        ->whereNotIn('id', function ($q) {
            $q->select('data_bahan_id')
              ->from('rekomendasi_user')
              ->where('user_id', auth()->id())
              ->whereDate('tanggal', now()->subDay());
        })

        // ❌ MENU YANG TIDAK DISUKAI
        ->when(!empty($tidak_suka), function ($q) use ($tidak_suka) {
            $q->whereNotIn('id', $tidak_suka);
        })
        ->select(
            '*',
            DB::raw("
                (
                    ABS(energi - ?) * 0.45 +
                    ABS(protein - ?) * 0.20 +
                    ABS(lemak - ?) * 0.15 +
                    ABS(karbo - ?) * 0.15 +
                    ABS(serat - ?) * 0.05
                ) AS skor_nutrisi
            ")
        )
        ->addBinding([
            $energi_target,
            $protein_target,
            $lemak_target,
            $karbo_target,
            $serat_target
        ], 'select')
        ->orderBy('skor_nutrisi')
        ->limit(30)   // 🔥 INI KUNCI VARIASI
        ->get();

    if ($kandidat->isEmpty()) {
        return null;
    }

    // =========================
    // 2. WEIGHTED RANDOM
    // =========================
    $kandidat = $kandidat->shuffle();

    // ambil random dari TOP 30
    return $kandidat->first();
}

   public function riwayat()
{
    $riwayat = RekomendasiUser::where('user_id', auth()->id())
        ->orderBy('tanggal', 'desc')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($item) {
            return $item->tanggal . '|' . $item->nama;
        });

    return view('user.rekomendasi-riwayat', compact('riwayat'));
}
public function hapusRiwayat($tanggal, $nama)
{
    RekomendasiUser::where('user_id', auth()->id())
        ->whereDate('tanggal', $tanggal)
        ->where('nama', $nama)
        ->delete();

    return redirect()
        ->route('riwayat')
        ->with('success', 'Riwayat berhasil dihapus.');
}


public function download($tanggal, $nama)
{
    $riwayat = RekomendasiUser::with('bahan')
        ->where('user_id', auth()->id())
        ->whereDate('tanggal', $tanggal)
        ->where('nama', $nama)
        ->orderBy('created_at', 'asc')
        ->get();

    if ($riwayat->isEmpty()) {
        return back()->with('error', 'Data tidak ditemukan');
    }

    $dataAnak = $riwayat->first();

    // ===============================
    // HITUNG TOTAL GIZI
    // ===============================
    $hasilGizi = [
        'energi'  => 0,
        'protein' => 0,
        'lemak'   => 0,
        'karbo'   => 0,
        'serat'   => 0,
    ];

    foreach ($riwayat as $item) {
        if ($item->bahan) {
            $hasilGizi['energi']  += $item->bahan->energi;
            $hasilGizi['protein'] += $item->bahan->protein;
            $hasilGizi['lemak']   += $item->bahan->lemak;
            $hasilGizi['karbo']   += $item->bahan->karbo;
            $hasilGizi['serat']   += $item->bahan->serat;
        }
    }

    $pdf = Pdf::loadView('pdf.rekomendasi', [
        'user'        => auth()->user(),
        'tanggal'     => Carbon::parse($dataAnak->tanggal)->format('d-m-Y'),
        'jam'         => Carbon::parse($dataAnak->created_at)->format('H:i'),

        // 🔽 DATA ANAK (FIX)
        'nama_anak'   => $dataAnak->nama,
        'jk'          => $dataAnak->jenis_kelamin ?? '-',
        'usia'        => $dataAnak->usia ?? '-',
        'berat'       => $dataAnak->berat ?? '-',
        'tinggi'      => $dataAnak->tinggi ?? '-',

        'riwayat'     => $riwayat,
        'hasilGizi'   => $hasilGizi,
    ]);

    return $pdf->download("rekomendasi-{$nama}-{$tanggal}.pdf");
}
}