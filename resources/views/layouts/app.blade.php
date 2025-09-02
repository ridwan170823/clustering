<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem UKT</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
  <nav class="bg-indigo-600 text-white">
    <div class="container mx-auto flex justify-between items-center p-4">
      <a href="{{ url('/') }}" class="text-lg font-semibold">Sistem UKT</a>
      <a href="{{ route('ukt.form') }}" class="px-3 py-2 rounded-md bg-white/10 hover:bg-white/20 text-sm">Prediksi UKT</a>
    </div>
  </nav>
  </nav>

  <main class="container mx-auto p-4 flex-grow">
    @yield('content')
  </main>

  <footer class="bg-gray-800 text-gray-200 text-center py-4">
    <p>&copy; {{ date('Y') }} Sistem UKT. Semua hak dilindungi.</p>
  </footer>
</body>
</html>