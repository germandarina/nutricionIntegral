<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>{{ strtoupper($plan->name)}} - {{ strtoupper($patient->full_name) }}</title>
    <style>
        @media print {
            .element-that-contains-table {
                overflow: visible !important;
            }
        }
        .page {
            overflow: hidden;
            page-break-after: always;
        }

        .page:last-of-type {
            page-break-after: auto
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 23cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
            /*width: 18cm !important;*/
        }

        /*#logo {*/
        /*    text-align: center;*/
        /*    margin-bottom: 10px;*/
        /*}*/

        /*#logo img {*/
        /*    width: 90px;*/
        /*}*/

        #logo_grande {
            text-align: center;
            /*margin-bottom: 10px;*/
            {{--background-image: {{ asset('img/ndf.png') }};--}}
        }

        #logo_grande img{
            width: 100%;
        }

        h1 {
            /*border-top: 1px solid  #5D6975;*/
            /*border-bottom: 1px solid  #5D6975;*/
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        h3.patient{
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center !important;
            margin: 0 0 20px 0;
        }

        #owner span {
            color: #5D6975;
            text-align: right;
            width: 85px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #owner td {
            white-space: nowrap;
            font-size: 20px !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            color: black;
            background-color: {{ $color_headers }};
            white-space: nowrap;
            font-weight: bold;
            text-align: left;
        }

        /*table td {*/
        /*    padding: 3px;*/
        /*    text-align: right;*/
        /*}*/


        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        h3{
            margin-bottom: 0px !important;
        }

        td img
        {
            display: block;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .super-centered {
            position:absolute;
            width:100%;
            /*height:100%;*/
            text-align:center;
            vertical-align:middle;
            z-index: 9999;
        }

        .macros {
            font-size: 12px !important;
        }
    </style>
</head>
<body>
<header>
    {!! $header !!}
</header>
<main>
    {!! $view_by_day !!}

    {!! $final_data !!}

</main>
</body>
</html>
