<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Wahyuning</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6M9 9h6M9 13h6M5 17h14"/></svg>
            Kalkulator Wahyuning
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>- {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/calculate') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Masukkan Angka</label>
                <input type="text" name="num1" value="{{ old('num1') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700">Masukkan Angka</label>
                <input type="text" name="num2" value="{{ old('num2') }}" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700">Operasi</label>
                <select name="operation" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="add" {{ old('operation') == 'add' ? 'selected' : '' }}>Penjumlahan (+)</option>
                    <option value="subtract" {{ old('operation') == 'subtract' ? 'selected' : '' }}>Pengurangan (-)</option>
                    <option value="multiply" {{ old('operation') == 'multiply' ? 'selected' : '' }}>Perkalian (×)</option>
                    <option value="divide" {{ old('operation') == 'divide' ? 'selected' : '' }}>Pembagian (/)</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded transition duration-200">
                Hitung
            </button>
        </form>

        @if (session('result'))
            <div class="mt-6 bg-green-100 text-green-700 p-4 rounded">
                <strong>Hasil:</strong> {{ session('result') }}
            </div>
        @endif

        @if (session('history'))
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Riwayat Perhitungan:</h2>
                <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                    @foreach (session('history') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>