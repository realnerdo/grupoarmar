<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $settings->title }}</title>
        <link rel="stylesheet" href="{{ asset('css/print.css') }}" media="screen">
    </head>
    <body>

        <section class="service-print">
            <header class="header">
                <div class="logo">
                    <img src="{{ asset('img/logo.jpg') }}" class="img">
                    <span class="title">{{ $settings->title }}</span>
                </div>
                <!-- /.logo -->
                <div class="folio">
                    <div class="number">
                        <span class="title">Servicio</span>
                        <span>No. {{ $service->folio }}</span>
                    </div>
                    <!-- /.number -->
                </div>
                <!-- /.folio -->
                <div class="info">
                    <span class="data"><b>Servicio</b></span>
                    <span class="data"><b>Fecha:</b> {{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</span>
                    <span class="data"><b>Contacto:</b> {{ $service->client->name }}</span>
                    <span class="data"><b>Teléfono:</b> {{ $service->client->phone }}</span>
                    <span class="data"><b>Evento:</b> {{ $service->event }}</span>
                    <span class="data"><b>Entrega/devolución:</b> {{ $service->date_start }} - {{ $service->date_end }}</span>
                </div>
                <!-- /.info -->
            </header>
            <!-- /.header -->
            <table class="service-table">
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th>Folio</th>
                        <th>Descripción</th>
                        <th>P. Unit.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $service_details = $service->service_details()
                            ->selectRaw('quantity, price, total, equipment_id')
                            ->groupBy(['quantity', 'price', 'total', 'equipment_id'])->get();
                    @endphp
                    @foreach ($service_details as $service_detail)
                        @php
                            $equipment = $service_detail->equipment;
                        @endphp
                        <tr>
                            <td>
                                <span class="qty">{{ $service_detail->quantity }}</span>
                            </td>
                            <td>
                                <span class="folio">{{ $equipment->folio }}</span>
                            </td>
                            <td>
                                <h4 class="equipment-title">{{ $equipment->title }}</h4>
                                <!-- /.equipment-title -->
                                <h5 class="equipment-brand"><b>Marca:</b> <i>{{ $equipment->brand->title }}</i></h5>
                                <!-- /.equipment-brand -->
                                <h5 class="equipment-group"><b>Grupo:</b> <i>{{ $equipment->group->title }}</i></h5>
                                <!-- /.equipment-group -->
                                <h5 class="equipment-warehouse"><b>Almacén:</b> <i>{{ $equipment->warehouse->title }}</i></h5>
                                <!-- /.equipment-warehouse -->
                                <div class="equipment-description">
                                    {{ $equipment->description }}
                                </div>
                                <!-- /.equipment-description -->
                            </td>
                            <td>
                                <span class="price">${{ $service_detail->price }}</span>
                            </td>
                            <td>
                                <span class="price">${{ $service_detail->total }}</span>
                            </td>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total">
                        <td colspan="4" class="tr"><b>Total</b></td>
                        <td colspan="1"><span id="grand_total" class="price">${{ $service->total }}</span></td>
                    </tr>
                </tfoot>
            </table>
            <!-- /.service-table -->
            <footer class="footer">
                <div class="contact">
                    <span class="address">{{ $settings->address }}</span>
                    <span class="phone">Tel. {{ $settings->phone }}</span>
                    <span class="email">{{ $settings->email }}</span>
                    <span class="title">{{ $settings->title }}</span>
                </div>
                <!-- /.contact -->
            </footer>
            <!-- /.footer -->
        </section>
        <!-- /.service-print -->
    </body>
</html>
