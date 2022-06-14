@extends('layouts.backend')

@section('title', 'Analisa')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Tambah Analisa' }}</h4>
    </div>

    <!-- konten disini -->
    <form method="POST" action="{{route('alternatives.store')}}">
        @csrf
        <div class="form-group">
            <div class="card center">
                <div class="card-body">
                    <div class="section-title mt-0">Masukan Data Kreditur</div>

                    <div class="form-group">
                        <label for="nasabah_id">Nama Nasabah</label>
                        <select name="nasabah_id" class="form-control">
                            <option value="">- Pilih Nasabah</option>
                            @foreach ($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}">{{ $nasabah->nama }}</option>
                            @endforeach
                        </select>
                        @error('nasabah_id')
                        <p class="text-sm">{{ 'required' }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_jaminan">Nilai Jaminan</label>
                        <input type="text" class="form-control number form-control-md" name="nilai_jaminan"
                            id="nilai_jaminan" value="{{ old('nilai_jaminan', '') }}">
                        @error('nilai_jaminan')
                        <p class="text-sm">{{ 'required' }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_pendapatan">Nilai Pendapatan</label>
                        <input type="text" class="form-control number form-control-md" name="nilai_pendapatan"
                            id="nilai_pendapatan" value="{{ old('nilai_pendapatan', '') }}">
                        @error('nilai_pendapatan')
                        <p class="text-sm">{{ 'required' }}</p>
                        @enderror
                    </div>

                    @foreach ($kriterias as $kriteria)
                    <div class="form-group">
                        <label for="kriteria[{{ $kriteria->id }}]">{{ $kriteria->nama }}</label>
                        <select class="form-control form-control-sm" id="kriteria[{{ $kriteria->id }}]"
                            name="kriteria[{{ $kriteria->id }}]">
                            @php
                            $resource = $bobots->where('kriteria_id', $kriteria->id)->all();
                            @endphp

                            @foreach ($resource as $cr)
                            <option value="{{ $cr->id}}">{{ $cr->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach

                    <div class="buttons">
                        <button class="btn btn-primary" value="submit">Masukan</button>
                    </div>

                </div>
            </div>
    </form>
</div>

</div>
@endsection