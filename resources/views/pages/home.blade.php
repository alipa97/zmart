@extends('layouts.master')

@section('content')

<!-- Hero Section -->
<section class="bg-indigo-600 text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-5xl font-bold mb-4">Badan Amil Zakat Nasional Kota Bontang</h1>
        <p class="text-xl mb-8">Pemetaan Manfaat Program Zmart Kota Bontang</p>
        <a href="{{ route('kios.map') }}" class="bg-white text-indigo-600 font-semibold py-2 px-6 rounded-full hover:bg-gray-200 transition">Lihat Peta Kios</a>
    </div>
</section>

<!-- Background/Tujuan Section -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-6">Latar Belakang & Tujuan</h2>
        <p class="text-lg text-center max-w-3xl mx-auto">
        Program Z-mart merupakan program bantuan di lembaga Baznas RI sebagai pemberdayaan ekonomi untuk mengembangkan warung atau toko yang dimiliki mustahik, dengan skala mikro sampai kecil. Program ini bertujuan untuk mengatasi kemiskinan di wilayah perkotaan
        </p>
    </div>
</section>
@endsection