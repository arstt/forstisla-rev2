@extends('layouts.backend')
@section('title', 'Nasabah')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('title', 'Analisa')

@section('content')
<div class="card">
  <div class="card-header">
    <h4>{{ 'Analisa' }}</h4>
  </div>
  <div class="container">

        @can('alternatives_create')
        <div class="buttons">
            <a href="{{ route('alternatives.create') }}" class="btn btn-primary">Tambah Data Analisa</a>
        </div>
        @else
        Kamu sudah mencapai batas. Tolong <a href="{{ route('billing') }}">Upgrade paket berlangganan</a>. <br/>
        @endcan

  </div>
  <!-- konten disini -->
  <table class="table" id="myTable">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nama Nasabah</th>
        @foreach ($kriterias as $kriteria)
        <th>{{$kriteria->nama}}</th>
        @endforeach
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        @foreach ($alternatives as $alternative)
        <td>{{ $alternative->nasabah->nama }}</td>
        @php
        $src = $scores->where('ida', $alternative->id)->all();
        @endphp
        @foreach ($src as $s)
        <td>{{ $s->deskripsi }}</td>
        @endforeach
        <td>
          <div class="buttons">
            <a href="{{ route('alternatives.edit', $alternative->id) }}" class="btn btn-icon btn-primary"><i
                class="far fa-edit"></i></a>
          </div>
          </form>
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
