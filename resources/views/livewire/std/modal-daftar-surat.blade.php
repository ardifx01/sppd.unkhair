<div class="modal fade" wire:ignore.self id="ModalDaftarSurat" tabindex="-1" aria-labelledby="ModalDaftarSuratLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Daftar Kode Surat</h5>
                <button type="button" class="close" wire:click="close_modal_daftar_surat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($show_daftar_surat)
                    <livewire:std.tampil-kode-surat>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="close_modal_daftar_surat"><i
                        class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
