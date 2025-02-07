<h4>Tanggal Pengajuan : <b>{{ $tgl_pengajuan }}</b></h4>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor STD</th>
            <th>Kegiatan STD</th>
            <th>Tanggal STD</th>
            <th>Pegawai</th>
            <th>Departemen/Unit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listsppd as $row)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $row->nomor_std }}</td>
                <td>{{ $row->kegiatan_std }}</td>
                <td>{{ tgl_indo($row->tanggal_std, false) }}</td>
                <td>
                    @php
                        $str = '<ul>';
                        foreach ($row->pegawai as $r) {
                            $str .= '<li>' . $r->nama_pegawai . '</li>';
                        }
                        $str .= '</ul>';
                        echo $str;
                    @endphp
                </td>
                <td>{{ $row->departemen->departemen ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
