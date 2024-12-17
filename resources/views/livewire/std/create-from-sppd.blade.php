<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $judul }}</h3>

        <div class="card-tools"></div>
    </div>
    <form wire:submit="save">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul_konten">
                            Nomor STD<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group w-25">
                            <input type="text" class="form-control" wire:model="nomor_std" placeholder="Nomor STD"
                                readonly>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" wire:click="show_modal_daftar_surat"
                                    id="button-addon2">Kode Surat</button>
                            </div>
                        </div>
                        @error('nomor_std')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Maksud Kegiatan STD<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model="kegiatan_std" rows="5" placeholder="Isi maksud perjalanan dinas"></textarea>
                        </div>
                        @error('kegiatan_std')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="judul_konten">
                            Tanggal Mulai Dinas<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group date w-25">
                            <input type="date" class="form-control" wire:model="tanggal_mulai_tugas" />
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @error('tanggal_mulai_tugas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Tanggal Selsai Dinas<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group w-25">
                            <input type="date" class="form-control" wire:model="tanggal_selesai_tugas">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        @error('tanggal_selesai_tugas')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Pegawai<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group">
                            <select class="form-control" style="width: 100%;">
                                <option selected="selected">{{ $nama_pegawai }}
                                </option>
                            </select>
                        </div>

                        @error('pegawai_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Departemen/Unit<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group">
                            <select class="form-control" wire:model="departemen_id" style="width: 100%;">
                                @if ($departemen_id && $departemen)
                                    <option value="{{ $departemen_id }}" selected="selected">{{ $departemen }}
                                    </option>
                                @endif
                            </select>
                        </div>

                        @error('departemen_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Ttd. Pimpinan<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group">
                            <select class="form-control w-50" wire:model="pimpinan_ttd">
                                <option value="">-- Pilih Pimpinan --</option>
                                @foreach ($pimpinan as $row)
                                    <option value="{{ $row->id }}"
                                        {{ $pimpinan_ttd == $row->id ? 'selected' : '' }}>
                                        {{ $row->nama_pimpinan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @error('pimpinan_ttd')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul_konten">
                            Keterangan Lainnya :
                        </label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Isi keterangan tambahan"></textarea>
                        </div>
                        @error('keterangan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire.target="save"><i class="fa fa-save"></i> Simpan</span>
                <span wire:loading wire.target="save"><span class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span> Please wait...</span>
            </button>

            @if ($id)
                <a href="{{ route('cetak.std', encode_arr(['stugas_id' => $id])) }}" target="_blank"
                    class="btn btn-default"><i class="fa fa-print"></i> Cetak STD</a>
            @endif

            <button type="button" class="btn btn-secondary float-right"
                onclick="location.href='{{ route('admin.std.index') }}'">
                <i class="fa fa-list"></i> Daftar STD
            </button>
        </div>
    </form>

    @include('livewire.std.modal-daftar-surat')

    @push('script')
        <script>
            function pilih(kodesurat_id) {
                Livewire.dispatch('generate-nomor-std', {
                    kodesurat_id: kodesurat_id
                });
            }
        </script>
    @endpush
</div>
