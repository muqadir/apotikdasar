<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
 
    <link rel="stylesheet" href="{{ asset('') }}" type="text/css"> 
    <style>
        /* .page-break {
            page-break-after: always;
        } */

       
    table {
    width: 100%;
    border-collapse: collapse;
    /* }
    table, th, td {
        border: 1px solid black;
    } */
    th, td {
        padding: 8px;
        text-align: left;
    }
    .title {
        margin-bottom: 5px;
        margin-top: 2px
    }
    .left-align {
            text-align: left;
    }
    .right-align {
        text-align: right;
    }
    .center-align {
        text-align: center;
    }
    .bold-text {
        font-weight: bold;
    }

    h4 {
    margin: 0;
}
.w-full {
    width: 100%;
}
.w-half {
    width: 50%;
}
.margin-top {
    margin-top: 1.25rem;
}
.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}
table {
    width: 100%;
    border-spacing: 0;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    background-color: rgb(96 165 250);
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
}
table tr.items {
    background-color: rgb(241 245 249);
}
table tr.items td {
    padding: 0.5rem;
}
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}

.garis {
    border: 1px solid black;
}
    </style>
</head>
<body>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ asset('laraveldaily.png') }}" alt="laravel daily" width="200" />
            </td>
            <td class="w-half">
                <h3>Nomor Faktur : {{ $nota }}</h3>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>{{ $data[0]->costumer }}</div>
                    <div>{{ $data[0]->alamat }}</div>
                    <div>{{ $data[0]->telp }}</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>{{ $data[0]->name }}</div>
                    <div>Banda Aceh</div>
                </td>
            </tr>
        </table>
    </div>
    {{-- <h1 class="title"> Faktur Penjualan</h1> --}}
    {{-- <h2 class="title"> No : {{ $nota }}</h2> --}}
    <table style="width:100%" class="products">
        <thead>
            <tr class="bold-text">
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                {{-- <th>Pajak</th> --}}
                <th>Diskon</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; $grandDiskon = 0; $grandsblDiskon = 0; ?>
            <?php $no = 1; ?>
            @foreach ($data as $row)
            <tr class="items">
                <td>{{ $no++ }}</td>
                <td>{{ $row->namaobat }}</td>
                <td class="right-align">{{ $row->qty }}</td>
                <td class="right-align">{{ number_format($row->jual, 2) }}</td>
                {{-- <td class="right-align">{{ number_format($row->pajak, 2) }}</td> --}}
                <?php
                    $diskont = ($row->diskon / 100) * $row->subtotal;
                    $subtotalsebelumDiskon = $row->subtotal + $row->pajak;
                    $subtotalSetelahDiskon = $subtotalsebelumDiskon - $diskont;
                    $grandsblDiskon  +=   $subtotalsebelumDiskon;
                    $grandTotal += $subtotalSetelahDiskon;
                    $grandDiskon += $diskont;
                ?>
                <td class="right-align">{{ number_format($diskont, 2) }}</td>
                <td class="right-align">{{ number_format($subtotalSetelahDiskon, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
    <div class="total">

        <table class="total">
            <tr style="background-color: rgb(96 165 250);">
                <td style="width: 60%"></td>
                <td style="width: 23%" class="left-align"> </td>
                <td style="width: 2%"></td>
                <td style="width: 15%"> </td>
            </tr>
            <tr >
                <td style="width: 60%"></td>
                <td style="width: 23%" class="left-align">Total </td>
                <td style="width: 2%">:</td>
                <td style="width: 15%">{{ number_format($data[0]->totalharga, 2) }} </td>
            </tr>
            <tr>
                <td style="width: 60%"></td>
                <td style="width: 23%" class="left-align">Diskon</td>
                <td style="width: 2%">:</td>
                <td style="width: 15%">{{ number_format($data[0]->totaldiskon, 2) }} </td>
            </tr>    
            <tr>
                <td></td>
                <td class="left-align">Besaran Uang</td>
                <td>:</td>
                <td>{{ number_format($data[0]->jumlahdibayar, 2) }} </td>
            </tr>
            <tr>
                <td></td>
                <td class="left-align">Pengembalian</td>
                <td>:</td>
                <td>{{ number_format($data[0]->kembali, 2) }} </td>
            </tr>
            <tr >
                <td></td>
                <td class="left-align">Total Harga</td>
                <td>:</td>
                <td>{{ number_format($data[0]->harusbayar, 2) }} </td>
            </tr>
            <tr style="background-color: rgb(96 165 250);">
                <td style="width: 60%"></td>
                <td style="width: 23%" class="left-align"> </td>
                <td style="width: 2%"></td>
                <td style="width: 15%"> </td>
            </tr>

        </table>
         
    </div>
 
    {{-- <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Muqadir</div>
    </div> --}}

    <!-- Skrip jQuery UI harus dimuat sebelum akhir tag </body> -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}
</body>
</html>