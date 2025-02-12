<div class="modal fade" wire:ignore.self id="{{ $modal }}" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="{{ $form }}" class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $judul }}</h5>
                    <button type="button" class="close" wire:click="_reset">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link {{ $currentStep == 1 ? 'active bg-light' : 'disabled' }}">
                                <i class="fa fa-search"></i> Cari SPPD
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link {{ $currentStep == 2 ? 'active bg-light' : 'disabled' }}">
                                <i class="fa fa-times"></i> Pembatalan SPPD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade {{ $currentStep == 1 ? 'show active' : '' }}" role="tabpanel"
                            aria-labelledby="username-tab">
                            <div class="form-group mt-2 w-25">
                                <label>Nomor SPPD<sup class="text-danger">*</sup> :</label>
                                <input type="text" wire:model="nomor_spd" class="form-control" id="nomor_spd"
                                    placeholder="Ketik Nomor SPPD">
                                @error('nomor_spd')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $currentStep == 2 ? 'show active' : '' }}" role="tabpanel"
                            aria-labelledby="role-tab">
                            <div class="table-responsive mb-0 border mt-2">
                                @if ($get)
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
                                            <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right warna-info">Alasan Pembatalan :</td>
                                            <td colspan="3">
                                                <textarea class="form-control" wire:model="alasan" rows="3" placeholder="Isi alasan pembatalan.."></textarea>
                                                @error('alasan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                            <div class="alert warna-danger mt-2">
                                <i class="fa fa-exclamation-circle"></i>
                                SPPD yang sudah dibatalkan maka
                                <b class="text-danger"><u>tidak dapat dikembalikan</u></b>,
                                sebelum menekan tombol <b>SAVE</b> pastika data sudah valid!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="_reset"><i
                            class="fa fa-times"></i>
                        Close</button>

                    @if ($currentStep == 1)
                        <button type="submit" class="btn btn-primary btn-sm float-right" wire:loading.attr="disabled"
                            wire:target="check">
                            <span wire:loading.remove wire.target="check">Next <i
                                    class="fa fa-arrow-circle-right"></i></span>
                            <span wire:loading wire.target="check">Please wait...</span>
                        </button>
                    @else
                        <button type="button" wire:click="back('1')" class="btn btn-sm btn-default"><i
                                class="fa fa-arrow-circle-left"></i>
                            Back</button>
                        <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled"
                            wire:target="save">
                            <span wire:loading.remove wire.target="save"><i class="fa fa-save"></i> Save</span>
                            <span wire:loading wire.target="save"><span class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span> Please wait...</span>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
