<div class="modal fade" wire:ignore.self id="{{ $modal }}" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $judul }}</h5>
                <button type="button" class="close" wire:click="_reset">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-2">
                @if ($get)
                    <div class="text-right mb-4">
                        <b style="font-size:12px;">Diajukan Oleh : &nbsp;</b>
                        <span class="badge bg-cyan">
                            <i class="fa fa-user"></i>
                            {{ $get->user?->name }}
                        </span>
                        <span class="badge bg-cyan">
                            <i class="fa fa-clock"></i>
                            {{ tgl_indo($get->created_at) }}
                        </span>
                    </div>
                    <div class="table-responsive mb-0 border">
                        <table class="table table-sm mb-0">
                            <tr>
                                <th class="text-right warna-warning" width="15%">Nomor SPPD :</td>
                                <td width="40%">
                                    {{ $get->nomor_spd }}
                                </td>

                                <th class="text-right warna-warning" width="15%">Nama Pegawai :</td>
                                <td width="30%">
                                    {{ $get->pegawai->nama_pegawai }} <br>
                                    NIP: {{ $get->pegawai->nip ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Perihal Kegiatan :</td>
                                <td>{{ $get->kegiatan_spd }}</td>

                                <th class="text-right warna-warning">Departemen/Unit :</td>
                                <td>{{ $get->departemen->departemen }}</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Berangkat Dari :</td>
                                <td>{{ $get->berangakat }}</td>

                                <th class="text-right warna-warning">Lama Perjalanan :</td>
                                <td>{{ $get->lama_pd }} hari</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Tujuan Ke :</td>
                                <td>{{ $get->tujuan }}</td>

                                <th class="text-right warna-warning">Tanggal Berangkat :</td>
                                <td>
                                    {{ tgl_indo($get->tanggal_berangakat, false) }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Transportasi :</td>
                                <td>{{ $get->angkutan }}</td>

                                <th class="text-right warna-warning">Tanggal Kembali :</td>
                                <td>
                                    {{ tgl_indo($get->tanggal_kembali, false) }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Kode MAK :</td>
                                <td colspan="3">{{ $get->kode_mak ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right warna-warning">Detail Alokasi Anggaran :</td>
                                <td colspan="3">{{ $get->detail_alokasi_anggaran ?? '' }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-info">Reviewer :</td>
                                <td colspan="3">
                                    {{ $get->reviwer?->name ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-info">Tanggal Review :</td>
                                <td colspan="3">
                                    {{ tgl_indo($get->tanggal_review ?? '') }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-info">Status Pengajuan :</td>
                                <td colspan="3">
                                    {!! str_status_sppd($get->status_spd ?? '') !!}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right warna-info">Alasan :</td>
                                <td colspan="3">
                                    {{ $get->alasan ?? '' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="_reset"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
