<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $judul }}</h3>

        <div class="card-tools"></div>
    </div>

    <form wire:submit="{{ $form }}">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="judul_konten">
                            Ketik Nomor SPPD<sup class="text-danger">*</sup> :
                        </label>
                        <div class="input-group w-25">
                            <input type="text" class="form-control" wire:model="nomor_sppd" placeholder="Nomor SPPD">
                        </div>
                        @error('nomor_sppd')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="checkSpd">
                <span wire:loading.remove wire.target="checkSpd"><i class="fa fa-search"></i> Cari SPD</span>
                <span wire:loading wire.target="checkSpd"><span class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true"></span> Please wait...</span>
            </button>

            <button type="button" class="btn btn-secondary float-right"
                onclick="location.href='{{ route('admin.std.index') }}'">
                <i class="fa fa-list"></i> Daftar STD
            </button>
        </div>
    </form>
</div>
