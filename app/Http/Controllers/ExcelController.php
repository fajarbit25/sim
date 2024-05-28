<?php

namespace App\Http\Controllers;

use App\Exports\AbsenGuru;
use App\Exports\ExportAbsen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportSims;
use App\Exports\GuruExport;
use App\Exports\SiswaExport;
use App\Imports\ImportGuru;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    public function exportSiswa()
    {
        return Excel::download(new SiswaExport, 'export-'.date('Ymd').'-data-siswa.xlsx');
    }

    public function exportAbsen($kelas, $mapel, $tanggal)
    {
        return Excel::download(new ExportAbsen($kelas, $mapel, $tanggal), date('Ymd').'absensi.xlsx');
    }

    public function exportGuru()
    {
        return Excel::download(new GuruExport, 'export-'.date('Ymd').'data-ptk.xlsx');
    }

    public function importGuru()
    {
        $data = [
            'title'     => 'Import Guru Excel',
        ];
        return view('guru.import', $data);
    }

    public function importGuruProses(Request $request)
    {
        //validasi form input
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = $request->file('file');
        $ekstensi = $file->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        //$filename = rand(1111, 9999).$file->getClientOriginalName();
        $path = 'ptk-excel/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($file));
        //Excel::import(new ImportSiswa, asset('storage/siswa-excel/'.$filename));

        Excel::import(new ImportGuru, $file);

        return redirect('/guru');
    }

    /**Absen Guru */
    public function absenGuru($mulai, $sampai)
    {
        return Excel::download(new AbsenGuru($mulai, $sampai), $mulai.'_sd_'.$sampai.'-absensi-guru.xlsx');
    }
}