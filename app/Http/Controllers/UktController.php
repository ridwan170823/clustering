<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\UktPrediction;
use App\Services\UktKMeans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UktController extends Controller {
  public function form(\App\Services\UktKMeans $svc) {
    $options = $svc->options(); // tetap gunakan label asli untuk pilihan
    return view('ukt.form', compact('options'));
}

public function predict(Request $r, \App\Services\UktKMeans $svc) {
    $data = $r->validate([
        'nama'       => 'required|string',
        'nim'        => 'required|string',
        'pendapatan' => 'required|string',
        'pekerjaan'  => 'required|string',
        'tanggungan' => 'required|string',
        'rumah'      => 'required|string',
        'status'     => 'required|string',
    ]);

    // mapping kembali ke label asli yang dipakai service
    $payload = [
        '1. Pendapatan Orang Tua'            => $data['pendapatan'],
        '2. Jenis pekerjaan orang tua'       => $data['pekerjaan'],
        '3. Jumlah tanggungan keluarga'      => $data['tanggungan'],
        '4. Kepemilikan rumah dan keadaannya'=> $data['rumah'],
        '5. Status keadaan orang tua'        => $data['status'],
    ];

    // simpan/updates student (opsional, sesuai skema kamu)
    $s = \App\Models\Student::updateOrCreate(
        ['nim' => $data['nim']],
        [
          'nama' => $data['nama'],
          'pendapatan'      => $data['pendapatan'],
          'pekerjaan_ortu'  => $data['pekerjaan'],
          'tanggungan'      => $data['tanggungan'],
          'kepemilikan_rumah'=> $data['rumah'],
          'status_ortu'     => $data['status'],
        ]
    );

    $pred = $svc->predict($payload);

    \App\Models\UktPrediction::create([
        'student_id' => $s->id,
        'cluster'    => $pred['cluster'],
        'tier'       => $pred['tier'],
        'vector'     => json_encode($pred['vector']),
    ]);

    return back()->with('ok', "Prediksi: {$pred['tier']} (cluster {$pred['cluster']})");
}
}