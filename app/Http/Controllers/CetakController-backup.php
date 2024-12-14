<?php

namespace App\Http\Controllers;

use App\Models\Pesertaukt;
use App\Models\SuratPerjalananDinas;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PDF extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, 'Title', 1, 0, 'C');
        $this->Ln(0);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
    }
}

class PDFL extends Fpdf
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 15);
        //Geser ke kanan
        $this->Cell(80);
        //Judul dalam bingkai
        $this->Cell(30, 10, 'Title', 1, 0, 'C');
        //Ganti baris
        $this->Ln(0);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
    }
}

class CetakController extends Controller
{
    public function sppd($params)
    {
        $params = decode_arr($params);
        if (!$params) {
            abort(403);
        }
        $sppd = SuratPerjalananDinas::with(['pegawai', 'departemen'])->where('id', $params['sppd_id'])->first();
        $pdf = new PDF('P', 'cm', 'legal');

        $pdf->isFinished = false;

        $pdf->AddPage();
        $thn = date('Y');

        $pdf->Image(public_path('images/logo.jpg'), 2, 0.6, 2.4, 2.2);
        $pdf->SetFont("Times", "B", 14);
        $pdf->Cell(20, 0.5, 'KEMENTERIAN PENDIDIKAN, SAIN DAN TEKNOLOGI', '', 0, 'C');
        $pdf->Ln();
        $pdf->Cell(20, 0.5, 'UNIVERSITAS KHAIRUN', '', 0, 'C');
        $pdf->Ln();
        $pdf->SetFont("Times", "", 10);
        $pdf->Cell(20, 0.5, 'Jalan Jusuf Abdurrahman Kampus Gambesi Kode Pos 97719 Ternate Selatan', '', 0, 'C');
        $pdf->Ln();
        $pdf->Cell(20, 0.5, 'Laman: www.unkhair.ac.id / Email: admin@unkhair.ac.id', '', 0, 'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetLineWidth(0.04);
        $pdf->line(19.5, 3, 2, 3);


        $pdf->SetFont("Times", "", 11);
        // geser cell ke sebelah kanan
        $pdf->Cell(11);
        $pdf->Cell(2, 0.5, 'Lembar Ke', 0, 0, 'L');
        $pdf->Cell(5, 0.5, ': (Satu) 1', 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(11);
        $pdf->Cell(2, 0.5, 'Nomor', 0, 0, 'L');
        $pdf->Cell(5, 0.5, ': ' . $sppd->nomor_spd, 0, 0, 'L');

        $pdf->Ln(0.9);
        $pdf->SetFont("Times", "", 11);
        $pdf->Cell(20, 0.5, 'SURAT PERJALANAN DINAS (SPD)', 0, 0, 'C');

        $pdf->Ln();
        $pdf->Ln();


        $pdf->SetFont("Times", "", 11);
        $pdf->Cell(1);
        $pdf->Cell(1, 0.5, '1', 1, 0, 'L');
        $pdf->Cell(7, 0.5, 'Pejabat Pembuat Komitmen', 1, 0, 'L');
        $pdf->Cell(9.5, 0.5, 'Rektor Universitas Khairun', 1, 0, 'L');

        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(1, 0.5, '2', "L", 0, 'L');
        $pdf->Cell(7, 0.5, 'Nama/NIP Pegawai yang melaksanakan', "L", 0, 'L');
        $pdf->Cell(9.5, 0.5, $sppd->pegawai->nama_pegawai, "LR", 0, 'L');
        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(1, 0.5, '', "LRB", 0, 'L');
        $pdf->Cell(7, 0.5, 'Perjalanan Dinas', "B", 0, 'L');
        $pdf->Cell(9.5, 0.5, "", "LRB", 0, 'L');

        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(1, 0.5, '3', "L", 0, 'L');
        $pdf->Cell(7, 0.5, 'a. Pangkat dan Golongan', "L", 0, 'L');
        $pdf->Cell(9.5, 0.5, 'a. -', "LR", 0, 'L');
        $pdf->Ln();
        $pdf->Cell(1);
        $pdf->Cell(1, 0.5, '', "LR", 0, 'L');
        $pdf->Cell(7, 0.5, 'b. Jabatan', "R", 0, 'L');
        $pdf->Cell(9.5, 0.5, 'b. ' . $sppd->pegawai->jabatan, "R", 0, 'L');



        $pdf->isFinished = true;

        $jud = 'SPPD - ' . $sppd->pegawai->nama_pegawai;

        //menampilkan output beupa halaman PDF
        $pdf->Output($jud, 'I');
        exit();
    }
}
