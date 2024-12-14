<div>
    <div class="row mb-2">
        <div class="col-md-2">
            <select class="form-control" wire:model.live.debounce.350="perPage">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            </select>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Pencarian..."
                    wire:model.live.debounce.350ms="pencarian">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-2 border p-0">
        <table class="table table-sm table-striped table-bordered mb-0" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="text-left">Kode Surat</th>
                    <th class="text-left">Keterangan</th>
                    <th>
                        <center>Aksi</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listdata as $row)
                    @php
                        $spasi = $row->parent_id ? str_repeat('&nbsp;', 4) : '';
                        $kode = $spasi . $row->kode;
                    @endphp
                    <tr>
                        <td>{{ ($listdata->currentpage() - 1) * $listdata->perpage() + $loop->index + 1 }}</td>
                        <td>{!! $kode !!}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td>
                            <center>
                                <button type="button" onclick="pilih('{{ $row->id }}')"
                                    class="btn btn-sm btn-warning">Pilih</button>
                            </center>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Data kosong!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $listdata->links() }}
</div>
