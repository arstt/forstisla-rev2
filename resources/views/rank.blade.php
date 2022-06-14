@extends('layouts.backend')

@section('title', 'Ranking')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Ranking Analisa' }}</h4>
    </div>
    <!-- konten disini -->
    <table class="table" id="myTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Resiko Gagal Bayar</th>
                <th scope="col">Tanggal Analisa</th>
                <th scope="col">Actoin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatives as $alternative)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $alternative->nasabah->nama }}</td>
                @php
                $src = $scores->where('ida', $alternative->id)->all();
                $total = 0;
                @endphp
                @foreach ($src as $s)
                @php
                $total += $s->bobot;
                @endphp
                @endforeach
                @if($total > 75)
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalRendah">
                        <i class="fas fa-info-circle"> Rendah</i>
                      </button>
                </td>
                @elseif($total < 40) <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalTinggi">
                        <i class="fas fa-info-circle"> Tinggi</i>
                      </button>
                    </td>
                    @else
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalCukup">
                            <i class="fas fa-info-circle"> Cukup</i>
                          </button>
                    </td>
                @endif
                <td>
                    {{ $alternative->created_at }}
                </td>
                <td>
                    <a href="{{ route('show.rank', $alternative->id) }}" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="modal fade" id="ModalRendah" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resiko Gagal Bayar Rendah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Seluruh aspek perhitungan terpenuhi. <br/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mengerti</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ModalCukup" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resiko Gagal Bayar Cukup</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Nasabah memiliki kriteria : <br/>
          <br>
          Jaminan         : BPKB Motor <br/>
          Pendapatan       : > 2 Juta - ≤ 3 Juta <br/>
          Pekerjaan        : Karyawan Swasta <br/>
          Usia             : ≥ 41 tahun – < 51 tahun <br/>
          Jenis Penggunaan : Upakara <br/>
          Tenor            : > 24 bulan - < 48 bulan <br/>
          <br>
          Nasabah dapat meningkatkan jenis Jaminan dan menurunkan jangka waktu peminjaman untuk mendapatkan resiko gagal bayar <span class="badge badge-success">RENDAH</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mengerti</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ModalTinggi" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resiko Gagal Bayar Tinggi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Nasabah memiliki kriteria : <br/>
            <br>
            Jaminan          : Tidak Menggunakan Jaminan <br/>
            Pendapatan       : ≤ 1 Juta <br/>
            Pekerjaan        : Petani <br/>
            Usia             : > 65 tahun <br/>
            Jenis Penggunaan : Konsumtif <br/>
            Tenor            : < 12 Bulan <br/>
            <br>
            Nasabah dapat meningkatkan jenis Jaminan untuk mendapatkan resiko gagal bayar <span class="badge badge-warning">CUKUP</span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mengerti</button>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body bobot-card">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body limit-card">
                                <table>
                                    <tr>
                                        <td>Tenor 12 Bulan</td>
                                        <td class="12bulan">: 90</td>
                                    </tr>
                                    <tr>
                                        <td>Tenor 24 Bulan</td>
                                        <td class="24bulan">: 90</td>
                                    </tr>
                                    <tr>
                                        <td>Tenor 36 Bulan</td>
                                        <td class="36bulan">: 90</td>
                                    </tr>
                                    <tr>
                                        <td>Tenor 48 Bulan</td>
                                        <td class="48bulan">: 90</td>
                                    </tr>
                                    <tr>
                                        <td>Tenor 60 Bulan</td>
                                        <td class="60bulan">: 90</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('dist/simple.money.format.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();

    } );
    $('.btn-info').click(function(e){
        e.preventDefault()
        $.ajax({
            url: $(this).attr("href"),
            method: "GET",
            success: function(res){
                const bobots = res.bobot
                let html = ''
                bobots.forEach((bob, index) => {
                    const des = bob[index]
                    html += `
                    <table>
                        <tr>
                            <td>${des.kriteria}</td>
                            <td>: ${des.bobot}</td>
                        </tr>
                    </table>
                    `
                })
                $('.bobot-card').html(html)
                const limit = res.limit
                $('.12bulan').text(`: Rp ${limit['12bulan'].toLocaleString()}`)
                $('.24bulan').text(`: Rp ${limit['24bulan'].toLocaleString()}`)
                $('.36bulan').text(`: Rp ${limit['36bulan'].toLocaleString()}`)
                $('.48bulan').text(`: Rp ${limit['48bulan'].toLocaleString()}`)
                $('.60bulan').text(`: Rp ${limit['60bulan'].toLocaleString()}`)
                $('#modalShow').modal('show')
            },
            error: (res) => {
                console.log(res.responseJSON)
                Swal.fire("Oops", "Something Wrong!", "error");
            }
        })
    })
</script>
@endpush
