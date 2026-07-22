<?php

namespace App\Exports;

use App\Models\QuizAttempt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    protected $kelasId;

    public function __construct($kelasId = null)
    {
        $this->kelasId = $kelasId;
    }
    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Kelas',
            'Nama Kuis',
            'Nilai',
            'Waktu Submit'
        ];
    }

    public function collection()
    {
        return QuizAttempt::with(['user.kelas', 'kuis'])
            ->when($this->kelasId, function ($q) {
                $q->whereHas('user', function ($query) {
                    $query->where('class_id', $this->kelasId);
                });
            })
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Siswa' => $item->user->name,
                    'Kelas' => $item->user->kelas->nama_kelas ?? '-',
                    'Nama Kuis' => $item->kuis->judul ?? '-',
                    'Nilai' => $item->score,
                    'Waktu Submit' => $item->created_at->format('d-m-Y H:i'),
                ];
            });
    }
}
