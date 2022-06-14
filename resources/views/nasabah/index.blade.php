@extends('layouts.backend')

@section('title', 'Nasabah')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h4>{{ 'Nasabah' }}</h4>
  </div>
  <div class="container">
    @can('nasabahs_create')
        <div class="buttons">
            <a href="{{ route('nasabah.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
    @else
    Kamu sudah mencapai batas. Tolong <a href="{{ route('billing') }}">Upgrade paket berlangganan</a>. <br/>
    @endcan

  </div>
  <!-- konten disini -->
  <table class="table" id="myTable">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID Nasabah</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($nasabah as $nasabah )
      <tr>
        <td>{{ $nasabah->id_nasabah }}</td>
        <td>{{ $nasabah->nama }}</td>
        <td>{{ $nasabah->alamat }}</td>
        <td>{{ $nasabah->jenis_kelamin }}</td>
        <td>
          <div class="buttons">
            <a href="{{ route('nasabah.show', $nasabah->id) }}" class="btn btn-icon btn-info"><i
                class="fas fa-info-circle"></i></a>
            <a href="{{ route('nasabah.edit', $nasabah->id) }}" class="btn btn-icon btn-primary"><i
                class="far fa-edit"></i></a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
            $('#myTable').DataTable();
        } );
</script>
@endpush
