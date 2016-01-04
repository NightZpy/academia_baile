@extends('pluranza.main')

@section('content')
<section class="ct-u-paddingTop20 ct-u-paddingBottom100">
    <div class="container">
        <div class="row ct-u-paddingBottom40">
            <div class="col-md-12">
                <div class="ct-u-sectionHeader text-center ct-u-paddingBottom20">
                    <h2 class="ct-sectionTitle">{{ $configuration->title }} <br>
                        <span class="ct-fw-300">
                            {{ $configuration->long_title }}
                        </span>
                    </h2>
                    <h2 class="ct-u-size18 ct-u-paddingTop20 text-justify-xs">
                        <span class="ct-u-colorMotive ct-fw-400">
                            {{ $configuration->slogan }}
                        </span>
                    </h2>
                    <h3 class="ct-u-size18 ct-u-paddingTop10 ct-u-paddingBottom20 text-justify-xs">
                        <span class="ct-fw-300">
                            <ul class="list-unstyled">
                                <li>
                                    <strong>Banco de Venezuela</strong>
                                </li>
                                <li><strong>Tipo de cuenta:</strong> <i>Corriente</i></li>
                                <li><strong>N° de Cuenta:</strong> <i>01 02 01 2929 0000 2526 83</i></li>
                                <li><strong>A nombre de:</strong> <i>Laura Castellanos</i></li>
                                <li><strong>C.I.:</strong> <i>V.- 24.153.460</i></li>
                                <li><strong>Correo:</strong> <i>lahoritac@gmail.com</i></li>
                            </ul>
                        </span> 
                    </h3>                   
                </div>
            </div>
        </div>
    </div>
</section>
@stop