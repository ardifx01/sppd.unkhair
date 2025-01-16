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
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="judul_konten">
                                    Nomor STD<sup class="text-danger">*</sup> :
                                </label>
                                <div class="input-group w-50">
                                    <input type="text" class="form-control" wire:model="nomor_std" readonly>
                                </div>
                                @error('nomor_std')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <label for="judul_konten">
                                    Tanggal STD<sup class="text-danger">*</sup> :
                                </label>
                                <div class="input-group">
                                    <input type="date" class="form-control" wire:model="tanggal_std">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('tanggal_std')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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
                        <div class="input-group" wire:ignore>
                            <select class="form-control" multiple="multiple" id="pegawai_id" wire:model="pegawai_id"
                                style="width: 100%;">
                                @foreach ($pegawai_selected as $row)
                                    <option value="{{ $row['id'] }}" selected="selected">{{ $row['nama'] }}
                                    </option>
                                @endforeach
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
                        <div class="input-group" wire:ignore>
                            <select class="form-control" id="departemen_id" wire:model="departemen_id"
                                style="width: 100%;">
                                <option value="{{ $departemen_id }}" selected="selected">{{ $departemen }}
                                </option>
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
                            <select class="form-control" wire:model="pimpinan_ttd">
                                <option value="">-- Pilih Pimpinan --</option>
                                @foreach ($pimpinan as $row)
                                    <option value="{{ $row->id }}"
                                        @if ($pimpinan_ttd == $row->id) selected @endif>
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

            {{-- @dump($status_std) --}}

            @if ($stugas_id && $status_std == '200')
                <a href="{{ route('cetak.std', encode_arr(['stugas_id' => $stugas_id])) }}" target="_blank"
                    class="btn btn-default"><i class="fa fa-print"></i> Cetak STD</a>
            @endif

            <button type="button" class="btn btn-secondary float-right"
                onclick="location.href='{{ route('admin.std.index') }}'">
                <i class="fa fa-list"></i> Daftar STD
            </button>
        </div>
    </form>

    @push('style')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('adminlte3') }}/plugins/select2/css/select2.min.css">
        <link rel="stylesheet"
            href="{{ asset('adminlte3') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @endpush

    @push('script')
        <!-- Select2 -->
        <script src="{{ asset('adminlte3') }}/plugins/select2/js/select2.full.min.js"></script>

        <script>
            $(function() {
                const pegawai = $('#pegawai_id');
                pegawai.select2({
                    theme: 'bootstrap4',
                    //minimumInputLength: 2,
                    minimumResultsForSearch: 10,
                    ajax: {
                        url: "{{ route('admin.pegawai.search-pegawai') }}",
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'search-pegawai'
                            }

                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    },
                    cache: true
                }).on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set('pegawai_id', selectedValues);
                    console.log('change : ' + selectedValues);
                });

                $('#departemen_id').select2({
                    theme: 'bootstrap4',
                    //minimumInputLength: 2,
                    minimumResultsForSearch: 10,
                    ajax: {
                        url: "{{ route('admin.departemen.search-departemen') }}",
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                search: params.term,
                                type: 'search-departemen'
                            }

                            // Query parameters will be ?search=[term]&type=user_search
                            return query;
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    },
                    cache: true
                }).on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set('departemen_id', selectedValues);
                });
            });
        </script>
    @endpush
</div>
