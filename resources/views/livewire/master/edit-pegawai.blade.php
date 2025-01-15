<div>
    <div class="modal fade" wire:ignore.self id="ModalFormEdit" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ $judul }}</h5>
                        <button type="button" class="close" wire:click="_reset">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-0">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link {{ $tabActive == 'identitas' ? 'active' : '' }} ml-1"
                                    type="button" role="tab" wire:click="tab('identitas')">Identitas</button>

                                <button class="nav-link {{ $tabActive == 'pegawai' ? 'active' : '' }} ml-1"
                                    type="button" role="tab" wire:click="tab('pegawai')">
                                    Pegawai
                                </button>

                                <button class="nav-link {{ $tabActive == 'kontak' ? 'active' : '' }} " type="button"
                                    role="tab" wire:click="tab('kontak')">
                                    Kontak
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="modal-body pt-0">
                        {{-- @dump($departemen_id, $nama_departemen, $mode, $tabActive) --}}
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade {{ $tabActive == 'identitas' ? 'show active' : '' }}"
                                role="tabpanel">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        NIK<sup class="text-danger">*</sup> :
                                    </label>
                                    <input type="text" class="form-control" wire:model="nik" placeholder="NIK">
                                    @error('nik')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        Nama Pegawai<sup class="text-danger">*</sup> :
                                    </label>
                                    <input type="text" class="form-control" wire:model="nama_pegawai"
                                        placeholder="Nama">
                                    @error('nama_pegawai')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        Jenis Kelamin<sup class="text-danger">*</sup> :
                                    </label>
                                    <select class="custom-select" size="2" wire:model="jk">
                                        <option value="L" {{ $jk == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                        <option value="P" {{ $jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jk')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        Tempat, Tanggal Lahir<sup class="text-danger">*</sup> :
                                    </label>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" wire:model="tempat_lahir"
                                                placeholder="Tempat Lahir">
                                            @error('tempat_lahir')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" wire:model="tanggal_lahir"
                                                placeholder="Tanggal Lahir">
                                            @error('tanggal_lahir')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        Agama<sup class="text-danger">*</sup> :
                                    </label>
                                    <select class="custom-select" wire:model="agama">
                                        <option value="">-- Pilih --</option>
                                        @foreach (agama() as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $agama ? 'selected' : '' }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="tab-pane fade {{ $tabActive == 'pegawai' ? 'show active' : '' }}"
                                role="tabpanel">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">NIP :</label>
                                    <input type="text" class="form-control" wire:model="nip" placeholder="NIP">
                                    @error('nip')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Pangkat :</label>
                                    <input type="text" class="form-control" wire:model="pangkat"
                                        placeholder="Pangkat">
                                    @error('pangkat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Golongan :</label>
                                    <input type="text" class="form-control" wire:model="golongan"
                                        placeholder="Golongan">
                                    @error('golongan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">
                                        Departemen/Unit<sup class="text-danger">*</sup> :
                                    </label>
                                    <div>
                                        <select class="custom-select" wire:model.defer="departemen_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($list_departemen as $row)
                                                <option value="{{ $row->id }}"
                                                    {{ $row->id == $departemen_id ? 'selected' : '' }}>
                                                    {{ $row->departemen }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('departemen_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Jabatan<sup
                                            class="text-danger">*</sup>
                                        :</label>
                                    <input type="text" class="form-control" wire:model="jabatan"
                                        placeholder="Jabatan">
                                    @error('jabatan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tugas Tambahan
                                        :</label>
                                    <input type="text" class="form-control" wire:model="jabatan_tugas_tambahan"
                                        placeholder="Tugas Tambahan">
                                    @error('jabatan_tugas_tambahan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="tab-pane fade {{ $tabActive == 'kontak' ? 'show active' : '' }}"
                                role="tabpanel">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">HP :</label>
                                    <input type="text" class="form-control" wire:model="hp"
                                        placeholder="Nomor HP">
                                    @error('hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email :</label>
                                    <input type="text" class="form-control" wire:model="email"
                                        placeholder="Email">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Alamat :</label>
                                    <textarea class="form-control" rows="3" wire:model="alamat" placeholder="Alamat"></textarea>
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer" wire:ignore>
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
</div>
