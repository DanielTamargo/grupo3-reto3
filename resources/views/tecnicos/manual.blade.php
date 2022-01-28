<?php /*
    vista donde los tecnicos podran descargar manuales de ascensores
*/?>
@extends('layouts.tecnico')

@section('title')
manuales
@endsection

@section('content')
    <p class="display-4">manuales disponibles</p>
    <ul class="list-group">
        <!-- despues blade generara los item de esta lista-->
        <li class="list-group-item">un manual <a href="#" class="float-end">descargar</a></li>
        <li class="list-group-item">un manual<a href="#" class="float-end">descargar</a></li>
        <li class="list-group-item">un manual<a href="#" class="float-end">descargar</a></li>
        <li class="list-group-item">un manual<a href="#" class="float-end">descargar</a></li>
        <li class="list-group-item">un manual<a href="#" class="float-end">descargar</a></li>
    </ul>
@endsection