@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-eye mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $tugas->user->nama }}</p>
            <p><strong>Tugas:</strong> {{ $tugas->tugas }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $tugas->tanggal_mulai }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ $tugas->tanggal_selesai }}</p>
        </div>
    </div>
@endsection