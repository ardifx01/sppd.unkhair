<div class="modal fade" wire:ignore.self id="ModalForm" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
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
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Pimpinan<sup
                                class="text-danger">*</sup> :</label>
                        <input type="text" class="form-control" wire:model="nama_pimpinan"
                            placeholder="Nama Pimpinan">
                        @error('nama_pimpinan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">NIP<sup class="text-danger">*</sup>
                            :</label>
                        <input type="text" class="form-control" wire:model="nip" placeholder="NIP Pimpinan">
                        @error('nip')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Golongan :</label>
                        <input type="text" class="form-control" wire:model="golongan" placeholder="Golongan">
                        @error('golongan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jabatan<sup class="text-danger">*</sup>
                            :</label>
                        <input type="text" class="form-control" wire:model="jabatan" placeholder="Jabatan">
                        @error('jabatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Singkat Jabatan<sup
                                class="text-danger">*</sup>
                            :</label>
                        <input type="text" class="form-control" wire:model="singkat_jabatan"
                            placeholder="Singkat Jabatan">
                        @error('singkat_jabatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            Mendelegasikan :
                        </label>
                        <select class="form-control" wire:model="user_id">
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
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
