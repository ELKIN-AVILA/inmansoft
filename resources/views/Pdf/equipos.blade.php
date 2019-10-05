@extends('adminlte::layouts.app')

        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Numero Placa</th>
                <th>Estado</th>
                <th>Tipo de Equipo</th>
                <th>Marca Equipo</th>
                <th>Modelo de Equipo</th>
                <th>Serial</th>
                <th>Fecha Compra</th>
                <th>Valor Compra</th>
                <th>Fecha de Egreso</th>
                <th>Proveedore</th>
            </thead>
            <tbody>
                @foreach($equipos as $mequi)
                    <tr>
                        <td>.</td>
                        <td>{{ $mequi->numplaca }}</td>
                        <td>{{ $mequi->estado }}</td>
                        <td>{{ $mequi->tipequipo_id }}</td>
                        <td>{{ $mequi->marcaequi_id }}</td>
                        <td>{{ $mequi->serial }}</td>
                        <td>{{ $mequi->fechacompra }}</td>
                        <td>{{ $mequi->valcompra }}</td>
                        <td>{{ $mequi->fechaegre }}</td>
                        <td>{{ $mequi->proveedores_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
