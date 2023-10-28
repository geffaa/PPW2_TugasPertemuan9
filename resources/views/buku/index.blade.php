<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<x-app-layout>
    <div class="container mx-auto mt-10 p-4">
        <h1 class="text-3xl font-semibold text-center mb-6 bg-gray-200 py-2">Daftar Buku</h1>
        <a href="{{ route('buku.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Tambah Buku</a>
        <div class="mb-4">
    <form action="{{ route('buku.search') }}" method="GET">
        <input type="text" name="search" placeholder="Cari Buku" class="rounded-l py-2 px-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" />
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-bold rounded-r">Cari</button>
    </form>
</div>

        <table class="w-full border-collapse border border-gray-300 bg-white shadow-md">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-300">No.</th>
                    <th class="px-4 py-2 border border-gray-300">Judul Buku</th>
                    <th class="px-4 py-2 border border-gray-300">Penulis</th>
                    <th class="px-4 py-2 border border-gray-300">Harga</th>
                    <th class="px-4 py-2 border border-gray-300">Tgl. Terbit</th>
                    <th class="px-4 py-2 border border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 0;
                @endphp
                @foreach ($data_buku as $buku)
                <tr>
                    <td class="px-4 py-2 border border-gray-300">{{ ++$no }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $buku->judul }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $buku->penulis }}</td>
                    <td class="px-4 py-2 border border-gray-300">Rp {{ number_format($buku->harga, 2) }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $buku->tgl_terbit }}</td>
                    <td class="px-4 py-2 border border-gray-300">
                        <a href="{{ route('buku.edit', $buku->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" class="text-red-500 hover:text-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @include('buku.pagination', ['paginator' => $data_buku])
        <div class="w-full flex flex-col items-center my-3">
            <div class="flex flex-col">{{$data_buku->links()}}</div>
        </div>

        <div class="mt-6 p-4 bg-white shadow-md">
            <p class="text-lg">Jumlah buku yang tersedia: {{ $jumlah_buku }}</p>
            <p class="text-lg">Total harga dari seluruh buku: Rp {{ number_format($total_harga, 2) }}</p>
        </div>
    </div>
    </x-app-layout>
</body>
</html>
