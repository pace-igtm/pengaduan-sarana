@extends('layout') 
 
@section('content') 
<div class="row"> 
    <div class="col-md-4"> 
        <div class="card p-3 mb-4"> 
            <h5 class="card-title">Buat Laporan Baru</h5> 
            <hr> 
            <form action="{{ route('siswa.store') }}" method="POST"> 
                @csrf 
                <div class="mb-3"> 
                    <label>Kategori</label> 
                    <select name="id_kategori" class="form-select" required> 
                        <option value="">Pilih Kategori</option> 
                        @foreach($kategori as $kat) 
                            <option value="{{ $kat->id_kategori }}">{{ $kat->ket_kategori }}</option> 
                        @endforeach 
                    </select> 
                </div> 
                <div class="mb-3"> 
                    <label>Lokasi Kejadian</label> 
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Ruang Lab 1" required> 
                </div> 
                <div class="mb-3"> 
                    <label>Keterangan Keluhan</label> 
                    <textarea name="ket" class="form-control" rows="3" placeholder="Jelaskan detail kerusakan..." required></textarea> 
                </div> 
                <button type="submit" class="btn btn-success w-100">Kirim Laporan</button> 
            </form> 
        </div> 
    </div> 
 
    <div class="col-md-8"> 
        <div class="card p-3"> 
            <h5 class="card-title">Riwayat Pengaduan Saya</h5> 
            <div class="table-responsive"> 
                <table class="table table-bordered table-hover mt-3"> 
                    <thead class="table-light"> 
                        <tr> 
                            <th>Tgl</th> 
                            <th>Kategori</th> 
                            <th>Keluhan</th> 
                            <th>Status</th> 
                            <th>Umpan Balik (Admin)</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @forelse($histori as $h) 
                            <tr> 
                                <td>{{ $h->created_at->format('d/m/Y') }}</td> 
                                <td>{{ $h->kategori->ket_kategori }}</td> 
                                <td> 
                                    <strong>{{ $h->lokasi }}</strong><br> 
                                    <small class="text-muted">{{ $h->ket }}</small> 
                                </td> 
                                <td> 
                                    @php  
                                        $status = $h->aspirasi->status; 
                                        $warna = 'secondary'; 
                                        if($status == 'Proses') $warna = 'warning'; 
                                        if($status == 'Selesai') $warna = 'success'; 
                                    @endphp 
                                    <span class="badge bg-{{ $warna }}">{{ $status }}</span> 
                                </td> 
                                <td> 
                                    {{ $h->aspirasi->feedback ?? '-' }} 
                                </td> 
                            </tr> 
                        @empty 

                            <tr> 
                                <td colspan="5" class="text-center">Belum ada laporan.</td> 
                            </tr> 
                        @endforelse 
                    </tbody> 
                </table> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection