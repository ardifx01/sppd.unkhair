<div>
    <button type="button" wire:click="editAkun" class="btn btn-primary ml-1">
        <i class="fa fa-user"></i> Edit Akun
    </button>

    <div class="modal fade" wire:ignore.self id="ModalEditAkun" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
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
                            <label for="exampleFormControlInput1" class="form-label">
                                Nama Lengkap<sup class="text-danger">*</sup> :</label>
                            <input type="text" class="form-control" wire:model="name" placeholder="Nama Lengkap">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                Email<sup class="text-danger">*</sup> :</label>
                            <input type="email" class="form-control" wire:model="email" placeholder="Email">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                User Login :</label>
                            <input type="text" class="form-control" wire:model="username" readonly>
                            <small class="text-muted">Anda tidak diijinkan untuk merubah data <b>User Login</b></small>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                Password Lama :</label>
                            <input type="text" class="form-control" wire:model="password_lama"
                                placeholder="Password Lama">
                            @error('password_lama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                Password Baru :</label>
                            <input type="text" class="form-control" wire:model="password_baru"
                                placeholder="Password Baru">
                            @error('password_baru')
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
</div>
