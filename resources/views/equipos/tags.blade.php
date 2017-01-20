<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Equipos</title>
        <link rel="stylesheet" href="{{ asset('css/tags.css') }}" media="screen">
    </head>
    <body>
        <div class="tags">
            @foreach ($equipment_details as $equipment_detail)
                @php
                    $equipment = $equipment_detail->equipment;
                @endphp
                <div class="tag">
                    <div class="equipment-folio"><b>{{ $equipment_detail->folio }}</b></div>
                    <!-- /.equipment-folio -->
                    <div class="equipment-title">{{ $equipment->title }}</div>
                    <!-- /.equipment-title -->
                    <div class="equipment-brand"><b>Marca: </b>{{ $equipment->brand->title }}</div>
                    <!-- /.equipment-brand -->
                    <div class="equipment-group"><b>Grupo: </b>{{ $equipment->group->title }}</div>
                    <!-- /.equipment-group -->
                    <div class="equipment-warehouse"><b>Almacén: </b>{{ $equipment->warehouse->title }}</div>
                    <!-- /.equipment-warehouse -->
                </div>
                <!-- /.tag -->
            @endforeach
        </div>
        <!-- /.tags -->
    </body>
</html>
