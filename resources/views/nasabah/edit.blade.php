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
    <form method="post" action="{{route('nasabah.update', $nasabah->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="card center">
              <div class="card-body">
                <div class="section-title mt-0">Perbaharui Data Nasabah</div>

                <div class="form-group">
                  <label for="id_nasabah">Kode Nasabah</label>
                  <input type="text" class="form-control form-control-md" name="id_nasabah" id="id_nasabah" value="{{$nasabah->id_nasabah}}">
                    @error('id_nasabah')
                        <p class="text-sm">{{ 'required' }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="number" class="form-control form-control-md" name="nik" id="nik" value="{{$nasabah->nik}}">
                      @error('nik')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control form-control-md" name="nama" id="nama" value="{{$nasabah->nama}}">
                      @error('nama')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control form-control-md" name="alamat" id="alamat" value="{{$nasabah->alamat}}">
                      @error('alamat')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control form-control-md" name="no_hp" id="no_hp" value="{{$nasabah->no_hp}}">
                      @error('no_hp')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="form-group">
                  <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                        @if ($nasabah->jenis_kelamin == "laki-laki")
                            <option value="laki-laki" selected='selected'>Laki - Laki</option>
                            <option value="perempuan">Perempuan</option>
                        @else
                            <option value="laki-laki">Laki - Laki</option>
                             <option value="perempuan" selected='selected'>Perempuan</option>
                         @endif
                    </select>
                  @error('jenis_kelamin')
                          <p class="text-sm">{{ 'required' }}</p>
                      @enderror
                </div>

                <div class="buttons">
                    <button class="btn btn-primary" value="submit">Simpan Pembaruan</button>
                  </div>

              </div>
            </div>
    </form>
</div>
@endsection
