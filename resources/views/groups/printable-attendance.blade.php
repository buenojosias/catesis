<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chamada</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 297mm;
            min-height: 210mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            border: black solid 1px;
            height: 100%;
            width: 100%;
        }

        table,
        th,
        td {
            padding: 0;
            border: 1px solid;
            border-collapse: collapse;
        }

        .header {
            padding: 0 1mm;
            border: black solid thin;
            font: 10pt "Arial";
            font-weight: 600;
        }

        .title {
            padding: 1mm;
            background-color: rgb(234, 234, 234);
            border-left: black solid thin;
            border-right: black solid thin;
            text-align: center;
            font: 11pt "Arial";
            font-weight: 600;
        }

        table {
            width: 100%;
            font: 9pt "Arial";
        }

        th {
            width: 6mm;
            text-align: center;
        }

        th>.date-day {
            display: block;
        }

        td.attendance {
            text-align: center;
            font-weight: 600;
        }

        td.attendance>.absence {
            color: #a90a0a;
        }

        td.column-name {
            width: 7cm;
        }

        td > .truncate {
            width: auto;
            min-width: 0;
            max-width: 6cm;
            display: inline-block;
            padding: 4px 2px 0 4px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        td > .truncate.removed {
            color: #555555;
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 297mm;
                height: 200mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>

    <div class="page">
        <div class="subpage">
            @livewire('group.printable-attendance', ['group' => $group])
        </div>
    </div>

    {{-- <script>
        window.print();
    </script> --}}
</body>

</html>
