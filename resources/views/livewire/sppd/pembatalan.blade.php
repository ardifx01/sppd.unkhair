<div class="modal fade" wire:ignore.self id="{{ $modal }}" tabindex="-1" aria-labelledby="ModalUpdateRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                                <i class="fa fa-check"></i> Pembatalan SPPD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade {{ $currentStep == 1 ? 'show active' : '' }}" role="tabpanel"
                            aria-labelledby="username-tab">
                            <div class="form-group mt-2">
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
                            <span wire:loading.remove wire.target="check">Selanjutnya <i
                                    class="fa fa-arrow-circle-right"></i></span>
                            <span wire:loading wire.target="check">Please wait...</span>
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled"
                            wire:target="save">
                            <span wire:loading.remove wire.target="save"><i class="fa fa-save"></i> Save</span>
                            <span wire:loading wire.target="save"><span class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span> Please wait...</span>
                        </button>
                        <button type="button" wire:click="back('1')" class="btn btn-sm btn-default"><i
                                class="fa fa-arrow-circle-left"></i>
                            Kembali</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
