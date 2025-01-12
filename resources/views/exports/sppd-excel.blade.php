<h4>Tanggal Pengajuan : <b>{{ $tgl_pengajuan }}</b></h4>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor SPPD</th>
            <th>Kegiatan SPPD</th>
            <th>Tanggal SPPD</th>
            <th>Tujuan</th>
            <th>Pegawai</th>
            <th>Departemen/Unit</th>
            <th>Nomor MAK</th>
            <th>Detail Alokasi</th>
            <th>Nilai Pencairan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listsppd as $row)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $row->nomor_spd }}</td>
                <td>{{ $row->kegiatan_spd }}</td>
                <td>{{ str_tanggal_dinas($row->tanggal_berangakat, $row->tanggal_kembali) }}</td>
                <td>{{ $row->tujuan }}</td>
                <td>{{ $row->nama_pegawai }}</td>
                <td>{{ $row->departemen->departemen ?? '-' }}</td>
                <td style="text-align:left;">{{ $row->kode_mak }}</td>
                <td>{{ $row->detail_alokasi_anggaran }}</td>
                <td>{{ 'Rp. ' . rupiah($row->nilai_pencairan) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
