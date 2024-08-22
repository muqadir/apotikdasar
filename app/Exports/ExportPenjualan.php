<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPenjualan implements FromCollection, WithHeadings
{
    protected $min;
    protected $max;

    public function __construct(array $data) 
    {
        $this->min = $data['min'] ?? null;
        $this->max = $data['max'] ?? null;

    }

    public function headings() : array
    {
        return [
            'No',
            'No Bukti',
            'Tanggal',
            'Pajak',
            'Diskon',
            'Total',
            'Dibayar',
            'Kembali',
            'Status',
            'Costumer',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (empty($this->min) || empty($this->max))  {
            $data = Pembayaran::joinJual()
                ->groupBy('pembayarans.nota')
                ->get();
          } else {
            $data = Pembayaran::joinJual()
                ->whereBetween('pembayarans.created_at',[$this->min, $this->max])
                ->groupBy('pembayarans.nota')
                ->get();
          };

          $export[] = 
            [
                'No',
                'No Bukti',
                'Tanggal',
                'Pajak',
                'Diskon',
                'Total',
                'Dibayar',
                'Kembali',
                'Status',
                'Costumer',
            ];

        $no = 1;
        foreach ($data as $key) {
            $export[] = [
                'No' => $no,
                'No Bukti' => $key->nota,
                'Tanggal' => $key->created_at,
                'Pajak' => $key->totalpajak,
                'Diskon' => $key->totaldiskon,
                'Total' => $key->totalharga,
                'Dibayar' => $key->jumlahdibayar,
                'Kembali' => $key->kembali,
                'Status' => $key->status,
                'Costumer' => $key->customer,
            ];
            $no++;
        }
        return collect($export);
    }
}