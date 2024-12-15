<?php

namespace App\Livewire\Std;

use App\Models\SuratPerjalananDinas;
use App\Models\SuratTugasDinas;
use Livewire\Component;

class PencarianSpd extends Component
{
    public $judul = "Pencarian SPD";

    public $form = 'checkSpd';
    public $nomor_sppd;

    public function render()
    {
        return view('livewire.std.pencarian-spd');
    }

    public function checkSpd()
    {
        $this->validate([
            'nomor_sppd' => 'required'
        ]);

        $err = 0;
        $spd = SuratPerjalananDinas::pencarian($this->nomor_sppd)->status_spd(['200'])->first();
        if (!$spd) {
            $err++;
            $this->dispatch('alert', type: 'error', title: 'Not Found!', message: 'Nomor SPPD "' . $this->nomor_sppd . '" tidak ditemukan!');
        } else {
            $cekStd = SuratTugasDinas::where('spd_id', $spd->id)->first();
            if ($cekStd) {
                $err++;
                return $this->redirect(route('admin.std.edit', encode_arr(['stugas_id' => $cekStd->id])));
            }
        }


        if (!$err) {
            $params = [
                'spd_id' => $spd->id
            ];
            return $this->redirect((route('admin.std.create-fromSppd-params', encode_arr($params))));
        }
    }
}
