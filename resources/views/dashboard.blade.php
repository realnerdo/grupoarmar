@extends('layout.base')

@section('title', 'Inicio')
@section('sectionTitle', 'Inicio')

@section('content')
    <div class="row">
        <div class="col-12">
            <section class="box">
                <h2 class="title">Eventos próximos</h2>
                <!-- /.title -->
                @if ($pending_services)
                    <table class="table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Evento</th>
                            <th>Contacto</th>
                            <th>Fecha de entrega</th>
                            <th>Fecha de término</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending_services as $pending_service)
                            @php
                                $now = \Date::now();
                                $start = \Date::createFromFormat('Y-m-d', $pending_service->date_start);
                                $end = \Date::createFromFormat('Y-m-d', $pending_service->date_end);
                            @endphp
                            <tr>
                                <td>{{ $pending_service->folio }}</td>
                                <td>{{ $pending_service->event }}</td>
                                <td>{{ $pending_service->client->name }}</td>
                                <td>{{ $start->format('d-m-Y') }} ({{ ucfirst($start->diffForHumans()) }})</td>
                                <td>{{ $end->format('d-m-Y') }} ({{ ucfirst($end->diffForHumans()) }})</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table -->
                @endif
            </section>
            <!-- /.box -->
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection
