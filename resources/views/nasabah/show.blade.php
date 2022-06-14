@extends('layouts.backend')

@section('title', 'Nasabah')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Nasabah' }}</h4>
    </div>
    <div class="container">
        <div class="buttons">
          <a href="{{ route('nasabah.index') }}" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    <!-- konten disini -->
    <div class="form-group">
        <div class="card center">
          <div class="card-body">
            <div class="section-title mt-0"> Data Lengkap Nasabah</div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID Nasabah</th>
                <td>{{ $nasabah->id_nasabah }}</td>
            </tr>
            <tr>
                <th scope="col">NIK</th>
                <td>{{ $nasabah->nik }}</td>
            </tr>
            <tr>
                <th scope="col">Nama</th>
                <td>{{ $nasabah->nama }}</td>
            </tr>
            <tr>
                <th scope="col">Alamat</th>
                <td>{{ $nasabah->alamat }}</td>
            </tr>
            <tr>
                <th scope="col">No. Hp</th>
                <td>{{ $nasabah->no_hp }}</td>
            </tr>
            <tr>
                <th scope="col">Jenis Kelamin</th>
                <td>{{ $nasabah->jenis_kelamin }}</td>
            </tr>
        </thead>
      </table>
            </div>
        </div>
    </div>
</div>
@endsection
