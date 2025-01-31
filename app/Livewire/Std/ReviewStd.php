<?php

namespace App\Livewire\Std;

use App\Models\SuratTugasDinas;
use Livewire\Attributes\On;
use Livewire\Component;

class ReviewStd extends Component
{
    public $modal = "ModalReviewSTD";
    public $judul = "Review Pengajuan STD";
    public $params;
    public $get;

    public $status_std, $alasan;

    public function render()
    {
        return view('livewire.std.review-std');
    }


    #[On('review-pengajuan-std')]
    public function review($params)
    {
        $this->params = decode_arr($params);
        $this->get = SuratTugasDinas::with(['pegawai', 'departemen', 'user'])->where('id', $this->params['stugas_id'])->first();
        dd($this);
        $this->dispatch('open-modal', modal: $this->modal);
    }

    public function save()
    {
        $rules = [
            'status_std' => 'required',
        ];

        if ($this->status_spd && $this->status_spd != '200') {
            $rules += ['alasan' => 'required'];
        }
        $this->validate($rules);

        SuratTugasDinas::where('id', $this->params['stugas_id'])->update([
            'status_std' => $this->status_std,
            'tanggal_review' => now(),
            'reviewer_id' => auth()->user()->id,
            'alasan' => $this->alasan,
        ]);

        $this->dispatch('alert', type: 'success', title: 'Succesfully', message: 'Berhasil Review Pengajuan STD');
        $this->_reset();
        $this->dispatch('load-datatable');
    }
}
