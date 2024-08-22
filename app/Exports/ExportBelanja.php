<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBelanja implements FromCollection, WithHeadings
{
    public function __construct(array $data) 
    {
        $this->min = $data['min'];
        $this->max = $data['max'];

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
            'Supplier',
            'Item',
        ];
    }
   
    public function collection()
    {
      if (empty($this->min) || empty($this->max))  {
        $data = Pembayaran::joinBeli()
            ->groupBy('pembayarans.nota')
            ->get();
      } else {
        $data = Pembayaran::joinBeli()
            ->whereBetween('pembayarans.created_at',[$this->min, $this->max])
            ->groupBy('pembayarans.nota')
            ->get();
      }
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
            'Supplier',
            'Item',
          ];
    
          $export = $data->map(function ($item, $key) {
            return [
                $key + 1,  // 'No'
                $item->nota,  // 'No Bukti'
                $item->created_at,  // 'Tanggal'
                $item->totalpajak,  // 'Pajak'
                $item->totaldiskon,  // 'Diskon'
                $item->totalharga,  // 'Total'
                $item->jumlahdibayar,  // 'Dibayar'
                $item->kembali,  // 'Kembali'
                $item->status,  // 'Status'
                $item->supplier,  // 'Supplier'
                $item->item,  // 'Item'
            ];
        });

        return $export;
                
    }
}

// class ExportBelanja implements FromCollection, WithHeadings
// {
//     protected $min;
//     protected $max;

//     public function __construct(array $data) 
//     {
//         $this->min = $data['min'];
//         $this->max = $data['max'];
//     }

//     public function headings() : array
//     {
//         return [
//             'No',
//             'No Bukti',
//             'Tanggal',
//             'Pajak',
//             'Diskon',
//             'Total',
//             'Dibayar',
//             'Kembali',
//             'Status',
//             'Supplier',
//             'Item',
//         ];
//     }

//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//     if (empty($this->min) || empty($this->max))  {
//         $data = Pembayaran::joinBeli()
//             ->groupBy('pembayarans.nota')
//             ->get();
//       } else {
//         $data = Pembayaran::joinBeli()
//             ->whereBetween('pembayarans.created_at',[$this->min, $this->max])
//             ->groupBy('pembayarans.nota')
//             ->get();
//       };

//         $export = $data->map(function ($item, $key) {
//             return [
//                 $key + 1,  // 'No'
//                 $item->nota,  // 'No Bukti'
//                 $item->created_at,  // 'Tanggal'
//                 $item->totalpajak,  // 'Pajak'
//                 $item->totaldiskon,  // 'Diskon'
//                 $item->totalharga,  // 'Total'
//                 $item->jumlahdibayar,  // 'Dibayar'
//                 $item->kembali,  // 'Kembali'
//                 $item->status,  // 'Status'
//                 $item->supplier,  // 'Supplier'
//                 $item->item,  // 'Item'
//             ];
//         });

//         return $export;
//     }
// }
