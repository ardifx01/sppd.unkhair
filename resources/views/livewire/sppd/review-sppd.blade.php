<div class="modal fade" wire:ignore.self id="{{ $modal }}" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form wire:submit.prevent="save" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $judul }}</h5>
                    <button type="button" class="close" wire:click="_reset">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($get)
                        <div class="table-responsive mb-0">
                            <table class="table table-sm mb-0" style="font-size:12px;">
                                <tr>
                                    <th class="text-right bg-light" width="15%">Nomor SPPD :</td>
                                    <td width="40%">
                                        {{ $get->nomor_spd }}
                                    </td>

                                    <th class="text-right bg-light" width="15%">Nama Pegawai :</td>
                                    <td width="30%">
                                        {{ $get->pegawai->nama_pegawai }} <br>
                                        NIP: {{ $get->pegawai->nip ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Perihal Kegiatan :</td>
                                    <td>{{ $get->kegiatan_spd }}</td>

                                    <th class="text-right bg-light">Departemen/Unit :</td>
                                    <td>{{ $get->departemen->departemen }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Berangkat Dari :</td>
                                    <td>{{ $get->berangakat }}</td>

                                    <th class="text-right bg-light">Lama Perjalanan :</td>
                                    <td>{{ $get->lama_pd }} hari</td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Tujuan Ke :</td>
                                    <td>{{ $get->tujuan }}</td>

                                    <th class="text-right bg-light">Tanggal Berangkat :</td>
                                    <td>
                                        {{ tgl_indo($get->tanggal_berangakat, false) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Transportasi :</td>
                                    <td>{{ $get->angkutan }}</td>

                                    <th class="text-right bg-light">Tanggal Kembali :</td>
                                    <td>
                                        {{ tgl_indo($get->tanggal_kembali, false) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">PPK :</td>
                                    <td colspan="3">
                                        <select class="form-control form-control-sm w-50" wire:model="pejabat_ppk">
                                            <option value="">-- Pilih PPK --</option>
                                            @foreach ($listppk as $row)
                                                <option
                                                    value="{{ encode_arr(['nama_ppk' => $row->nama_pimpinan, 'nip' => $row->nip, 'pimpinan_id' => $row->id]) }}"
                                                    {{ data_params($pejabat_ppk, 'pimpinan_id') == $row->id ? 'selected' : '' }}>
                                                    {{ $row->nama_pimpinan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pejabat_ppk')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Status Pengajuan :</td>
                                    <td colspan="3">
                                        <select class="form-control form-control-sm w-25" wire:model="status_spd">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="200" {{ $status_spd == '200' ? 'selected' : '' }}>
                                                Pengajuan Disetuji</option>
                                            <option value="406" {{ $status_spd == '406' ? 'selected' : '' }}>
                                                Pengajuan Ditolak</option>
                                        </select>
                                        @error('status_spd')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right bg-light">Alasan :</td>
                                    <td colspan="3">
                                        <textarea class="form-control form-control-sm" wire:model="alasan" rows="3"
                                            placeholder="Isi alasan jika diperlukan.."></textarea>
                                        @error('alasan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="_reset"><i
                            class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled"
                        wire:target="save">
                        <span wire:loading.remove wire.target="save"><i class="fa fa-save"></i> Save</span>
                        <span wire:loading wire.target="save"><span class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span> Please wait...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
