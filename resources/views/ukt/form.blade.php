@extends('layouts.app')
@section('content')

@if ($errors->any())
   <div class="mb-4 rounded bg-red-100 text-red-700 p-4">
    <ul class="list-disc list-inside">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

@if(session('ok'))
  <div class="mb-4 rounded bg-green-100 text-green-700 p-4">{{ session('ok') }}</div>
@endif

<h3 class="text-2xl font-bold mb-6">Prediksi UKT</h3>
<div id="progress" class="mb-4 text-sm text-gray-600"></div>

<form method="POST" action="{{ route('ukt.predict') }}" class="bg-white p-6 rounded shadow space-y-6">
  @csrf
  <div class="form-step space-y-4">
    <div>
      <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
      <input id="nama" name="nama" type="text" value="{{ old('nama') }}" class="mt-1 block w-full rounded border-gray-300" required>
    </div>
    <div>
      <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
      <input id="nim" name="nim" type="text" value="{{ old('nim') }}" class="mt-1 block w-full rounded border-gray-300" required>
    </div>
    <div class="text-right">
      <button data-next class="px-4 py-2 bg-indigo-600 text-white rounded">Berikutnya</button>
    </div>
  </div>

  <div class="form-step hidden space-y-4">
    <div>
      <label for="pendapatan" class="block text-sm font-medium text-gray-700">1. Pendapatan Orang Tua</label>
      <select id="pendapatan" name="pendapatan" class="mt-1 block w-full rounded border-gray-300" required>
        @foreach ($options['1. Pendapatan Orang Tua'] as $label => $v)
          <option value="{{ $label }}" @selected(old('pendapatan') == $label)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex justify-between">
      <button data-prev class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
      <button data-next class="px-4 py-2 bg-indigo-600 text-white rounded">Berikutnya</button>
    </div>
  </div>

  <div class="form-step hidden space-y-4">
    <div>
      <label for="pekerjaan" class="block text-sm font-medium text-gray-700">2. Jenis pekerjaan orang tua</label>
      <select id="pekerjaan" name="pekerjaan" class="mt-1 block w-full rounded border-gray-300" required>
        @foreach ($options['2. Jenis pekerjaan orang tua'] as $label => $v)
          <option value="{{ $label }}" @selected(old('pekerjaan') == $label)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex justify-between">
      <button data-prev class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
      <button data-next class="px-4 py-2 bg-indigo-600 text-white rounded">Berikutnya</button>
    </div>
  </div>

  <div class="form-step hidden space-y-4">
    <div>
      <label for="tanggungan" class="block text-sm font-medium text-gray-700">3. Jumlah tanggungan keluarga</label>
      <select id="tanggungan" name="tanggungan" class="mt-1 block w-full rounded border-gray-300" required>
        @foreach ($options['3. Jumlah tanggungan keluarga'] as $label => $v)
          <option value="{{ $label }}" @selected(old('tanggungan') == $label)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex justify-between">
      <button data-prev class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
      <button data-next class="px-4 py-2 bg-indigo-600 text-white rounded">Berikutnya</button>
    </div>
  </div>

  <div class="form-step hidden space-y-4">
    <div>
      <label for="rumah" class="block text-sm font-medium text-gray-700">4. Kepemilikan rumah dan keadaannya</label>
      <select id="rumah" name="rumah" class="mt-1 block w-full rounded border-gray-300" required>
        @foreach ($options['4. Kepemilikan rumah dan keadaannya'] as $label => $v)
          <option value="{{ $label }}" @selected(old('rumah') == $label)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex justify-between">
      <button data-prev class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
      <button data-next class="px-4 py-2 bg-indigo-600 text-white rounded">Berikutnya</button>
    </div>
  </div>

  <div class="form-step hidden space-y-4">
    <div>
      <label for="status" class="block text-sm font-medium text-gray-700">5. Status keadaan orang tua</label>
      <select id="status" name="status" class="mt-1 block w-full rounded border-gray-300" required>
        @foreach ($options['5. Status keadaan orang tua'] as $label => $v)
          <option value="{{ $label }}" @selected(old('status') == $label)>{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="flex justify-between">
      <button data-prev class="px-4 py-2 bg-gray-200 rounded">Sebelumnya</button>
      <button class="px-4 py-2 bg-indigo-600 text-white rounded">Prediksi</button>
    </div>
  </div>
</form>
@endsection