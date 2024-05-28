<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BUKTI PENDAFTARAN PPDB SMKIT IBNUL QAYYIM</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        table{
            width: 100%;
            border: none;
        }
        .foto{
            width: 200px;
        }
        .left{
            width: 300px;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="2">
                <strong>Biodata Siswa</strong>
            </td>
            <td rowspan="3" class="foto text-center">
                <img src="{{$imgUrl}}" style="width: 120px" alt="img">
            </td>
        </tr>
        <tr>
            <td class="left">xxxx</td>
            <td>xxxx</td>
        </tr>
        <tr>
            <td>xxxx</td>
            <td>
                <div id="loadFoto">

                </div>
            </td>
        </tr>
    </table>
    <script>
        $(document).ready(function(){
            $("#loadFoto").load('http://127.0.0.1:8000/ppdb/generate_qrcode');
});
    </script>
</body>
</html>