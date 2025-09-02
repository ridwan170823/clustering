<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    <header class="p-6 text-right">
        @if (Route::has('login'))
            <nav class="flex justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    
          </header>
           <main>
        <section class="container mx-auto px-6 pt-8 pb-16">
            <div class="flex flex-col-reverse items-center gap-8 md:flex-row">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-4">Prediksi UKT Lebih Mudah</h1>
                    <p class="mb-6 text-lg text-gray-600">Gunakan aplikasi kami untuk memprediksi UKT secara cepat dan akurat.</p>
                    <a href="{{ url('/ukt') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Mulai Prediksi</a>
                </div>
                 <div class="w-full md:w-1/2">
                    <img src="https://placehold.co/600x400" alt="Ilustrasi" class="w-full h-auto rounded-lg shadow">
                </div>
</div>
</section>
<section class="container mx-auto px-6 pb-16">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Akurasi Tinggi</h3>
                    <p class="text-gray-600">Model kami dilatih dengan data terbaru untuk hasil yang akurat.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Mudah Digunakan</h3>
                    <p class="text-gray-600">Antarmuka yang sederhana memudahkan siapa pun untuk memprediksi.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Cepat dan Responsif</h3>
                    <p class="text-gray-600">Dapatkan hasil prediksi hanya dalam hitungan detik.</p>
                </div>
            </div>
        </section>
    </main>
</body>
  
</html>
