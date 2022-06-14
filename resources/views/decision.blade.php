@extends('layouts.backend')

@section('title', 'Matrix')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Decision Matrix' }}</h4>
    </div>
    <!-- konten disini -->
    <table class="table" id="myTable">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nama</th>
            @foreach ($kriterias as $kriteria)
            <th scope="col">{{ $kriteria->nama }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
            @foreach ($alternatives as $alternative)
            <tr>
                <td>{{ $alternative->nama_nasabah }}</td>
                @php
                    $src = $scores->where('ida', $alternative->id)->all();
                @endphp
                @foreach ($src as $s)
                <td>{{ $s->bobot }}</td>
                @endforeach
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

