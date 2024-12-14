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
                    @if ($turunan)
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                Induk Kode Surat<sup class="text-danger">*</sup> :
                            </label>
                            <select class="form-control" wire:model="parent_id" wire:change="kode_turunan()">
                                <option value="">-- Pilih --</option>
                                @foreach ($parent_kode_surat as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $parent_id ? 'selected' : '' }}>
                                        [{{ $row->kode }}] - {{ $row->keterangan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">
                            Kode<sup class="text-danger">*</sup> :
                        </label>
                        <input type="text" class="form-control" wire:model="kode" placeholder="Kode Surat">
                        @error('kode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">
                            Keterangan<sup class="text-danger">*</sup> :
                        </label>
                        <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Keterangan"></textarea>
                        @error('keterangan')
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
