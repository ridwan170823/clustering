@extends('layouts.app')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

@if(session('ok')) 
  <div class="alert alert-success">{{ session('ok') }}</div>
@endif

<h3>Prediksi UKT</h3>
<form method="POST" action="{{ route('ukt.predict') }}">
  @csrf
  <input name="nama" class="form-control mb-2" placeholder="Nama" required>
  <input name="nim" class="form-control mb-2" placeholder="NIM" required>

  {{-- gunakan key aman dari controller --}}
  <label class="mt-2">1. Pendapatan Orang Tua</label>
  <select name="pendapatan" class="form-control" required>
    @foreach ($options['1. Pendapatan Orang Tua'] as $label => $v)
      <option value="{{ $label }}">{{ $label }}</option>
    @endforeach
  </select>

  <label class="mt-2">2. Jenis pekerjaan orang tua</label>
  <select name="pekerjaan" class="form-control" required>
    @foreach ($options['2. Jenis pekerjaan orang tua'] as $label => $v)
      <option value="{{ $label }}">{{ $label }}</option>
    @endforeach
  </select>

  <label class="mt-2">3. Jumlah tanggungan keluarga</label>
  <select name="tanggungan" class="form-control" required>
    @foreach ($options['3. Jumlah tanggungan keluarga'] as $label => $v)
      <option value="{{ $label }}">{{ $label }}</option>
    @endforeach
  </select>

  <label class="mt-2">4. Kepemilikan rumah dan keadaannya</label>
  <select name="rumah" class="form-control" required>
    @foreach ($options['4. Kepemilikan rumah dan keadaannya'] as $label => $v)
      <option value="{{ $label }}">{{ $label }}</option>
    @endforeach
  </select>

  <label class="mt-2">5. Status keadaan orang tua</label>
  <select name="status" class="form-control" required>
    @foreach ($options['5. Status keadaan orang tua'] as $label => $v)
      <option value="{{ $label }}">{{ $label }}</option>
    @endforeach
  </select>

  <button class="btn btn-primary mt-3">Prediksi</button>
</form>
@endsection