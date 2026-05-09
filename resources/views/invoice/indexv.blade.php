<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Seven Dental Clinic</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .background-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://sevendentalsurabaya.com/wp-content/uploads/2026/05/WhatsApp-Image-2025-04-30-at-1.25.36-PM-e1751080693519-1.jpeg');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.2;
            z-index: -1;
        }

        .invoice-content {
            position: relative;
            z-index: 2;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: left;
            padding-left: 0px;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 40px;
            line-height: 40px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 30px;
        }

        .invoice-box table tr.heading td {
            background: #ffffff;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
            padding-bottom: 20px;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .jumlah-box {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            background-color: #f0f0f0;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
            width: 100%;
            white-space: nowrap;
        }

        .signature-box {
            text-align: right !important;
        }

        .noin {
            text-align: right !important;
            padding-bottom: 30px !important;
        }

        .invoice-box table tr td:nth-child(1) {
            font-weight: semi-bold;
        }

        .invoice-box table tr td:nth-child(2) {
            padding-left: 10px;
        }

        .heading {
            margin-top: 15px !important;
        }

        .title {
            padding-bottom: 30px !important;
        }

        .ppp {
            width: 30% !important;
            font-weight: 500 !important;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="background-container"></div>

        <div class="invoice-content">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title" style="text-align: center; height: 52px; padding-top: 15px; transform: translateX(-40px);">
                                    <p style="font-size: 14px; font-weight: bold; margin: 0; line-height: 1.2;">{{ $invoice->header_title }}</p>
                                    <p style="font-size: 10px; margin: 0; line-height: 1.2;">{{ $invoice->address_line1 }}</p>
                                    <p style="font-size: 10px; margin: 0; line-height: 1.2;">Mulyorejo - Surabaya, Jawa Timur 60115</p>
                                    <p style="font-size: 10px; margin: 0; line-height: 1.2;">Telp. 0856-4844-3455</p>
                                </td>

                                <td class="noin">
                                    <p>KWITANSI {{ $invoice->no_invoice }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="details">
                    <td class="ppp">Telah diterima dari </td>
                    <td>: <span class="left-aligned">{{ $invoice->patient->nama }}</span></td>
                </tr>

                <tr class="item">
                    <td class="ppp">Terbilang </td>
                    <td>: <span class="left-aligned">{{ $invoice->terbilang }}</span></td>
                </tr>

                <tr class="item">
                    <td class="ppp">Jenis Perawatan </td>
                    <td>: <span class="left-aligned">{{ implode(', ', json_decode($invoice->jenis_perawatan)) }}</span></td>
                </tr>

                <tr class="item last">
                    <td class="ppp"></td>
                    <td>
                        <span class="left-aligned">
                            {!! $invoice->notes ? nl2br(e($invoice->notes)) : '<br/><br/>' !!}
                        </span>
                    </td>
                </tr>

                <tr class="heading">
                    <td>
                        <div class="jumlah-box">
                            Jumlah &nbsp; &nbsp; &nbsp;: &nbsp; &nbsp; &nbsp; <span>{{ number_format($invoice->jumlah, 2)}}</span>
                        </div>
                    </td>

                    <td class="signature-box">
                        <p>Surabaya, {{ \Carbon\Carbon::parse($invoice->paid_date)->format('d M Y') }}</p>
                        <p><br/></p>
                        <p><br/></p>
                        <p>(..........................)</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
