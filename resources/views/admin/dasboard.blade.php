@extends('layout')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Aspirasi Siswa</h4>
    </div>

    <form action="{{ route('admin.dashboard')}}" method="GET" class="row g-3 mb-4 bg-light p-2 rounded">
        <div class="col-auto">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tangal')}}">
        </div> 
        <div class="col-auto">
            <select name="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($kategori_list as $k)
                <option value="{{ $k-id_kategori}}" {{ request('kategori') == $k->id_kategori ?
                    'selected' : ''}}>
                                            {{ $k-.ket_kategori}}
                                        </option>
                                    @endforech
                                </select>
                            </div>
                            <div class="col-aito">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('adminn.dashboard')}}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Tgl</th>
                                        <th>NIS / Siswa</th>
                                        <th>Kategori</th>
                                        <th>Laporan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporan as $row)
                                    <tr>
                                        <td>{{ $row->created_at->format('d-m-y') }}</td>
                                        <td>{{ $row->nis }} <br> <small>{{ $row->siswa->kelas }}</small></td>
                                        <td>{{ $row->kategori->ket_kategori }}</td>
                                        <td>
                                            <b>{{ $row->lokasi }}</b> <br> {{ $row-ket }}
                                        </td>
                                        <td>
                                            @php
                                                $status = $row->aspirasi->status;
                                                $color = $status == 'Selesai' ? 'success' : ($satus == 'Proses' ?
                                                'warning' : 'secondary');
                                                                              @endphp
                                                                              <span class="badge bg-{{ $color }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info text-white" data-bs-
                                        toggle="modal" data-bs-target="#modalEdit{{ $row->id_pelaporan }}">
                                                                        Update
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                            <div class="modal-fade" id="modalEdit{{ $row->id_pelaporan }}" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Update Status Laporan</h5>
                                                                            <button type="button" class="btn-close" data-bs dismiss="modal"></button>
                                                                        </div>
                                                                        <form action="{{ route('admin.update', $row->id_pelaporan)}}"
                                                                            method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label>Status Penyelesaian</label>
                                                                                <select name="status" class="form-select">
                                                                                    <option value="Menunggu" {{ $row->aspirasi->status ==
                                                                                        'Menunggu' ? 'selected' : ''}}>Menunggu</option>

                                                                                    <option value="Proses" {{ $row->aspirasi->status ==
                                                                                           'Proses' ? 'selected' : '' }}>Proses</option>

                                                                                    <option value="Selesai" {{ $row->aspirasi->status == 
                                                                                        'Selesai' ? 'selected : '' }}>Selesai</option>
                                                                                </select>
                                                                            </div>
                                                                    <div class="mb-3">
                                                                        <label>Umpan Balik / Keterangan Perbaikan</label>
                                                                        <textarea name="feedback" class="form-control" rows="3"
                                                                        placeholder="Contoh: Sudah diperbaiki oleh teknisi ">{{ $row->aspirasi->feedback }}</textarea>
                                                                    </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-
                                                                            dismiss="modal">Batal</button>
                                                                            <button type="submit" class ="btn btn-primary">Simpan Perubahan</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center">Tidak ada data laporan.</td>
                                                                </tr>
                                                                @endforelse
                                                                </tbody>
                            </table>
                        </div>
</div>
@endsection          
