@extends('layouts.backend')

@section('title', 'Nasabah')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Tambah Data Nasabah' }}</h4>
    </div>

    <!-- konten disini -->

    <form method="post" action="{{route('nasabah.store')}}">
        @csrf
        <div class="form-group">
            <div class="card center">
              <div class="card-body">
                <div class="section-title mt-0">Masukan Data Nasabah</div>

                <div class="form-group">
                  <label for="id_nasabah">Kode Nasabah</label>
                  <input type="text" class="form-control form-control-md" name="id_nasabah" id="id_nasabah" value="{{ old('id_nasabah', '') }}">
                    @error('id_nasabah')
                        <p class="text-sm">{{ 'required' }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control form-control-md" name="nik" id="nik" value="{{ old('nik', '') }}">
                      @error('nik')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control form-control-md" name="nama" id="nama" value="{{ old('nama', '') }}">
                      @error('nama')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control form-control-md" name="alamat" id="alamat" value="{{ old('alamat', '') }}">
                      @error('alamat')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control form-control-md" name="no_hp" id="no_hp" value="{{ old('no_hp', '') }}">
                      @error('no_hp')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                  <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="laki-laki">Laki - Laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>

                <div class="buttons">
                    <button class="btn btn-primary" value="submit">Tambah Data</button>
                  </div>

              </div>
            </div>
    </form>
</div>
@endsection
