<section class="ct-u-paddingTop5 ct-u-paddingBottom10">
    <div class="container">
        <div class="row ct-u-paddingTop15 ct-u-paddingBottom15">
            @foreach ($paymentAcademies as $academy)
                <div class="col-md-2">
                    <a target="_blank" href="{{ $academy->logo->url() }}"><img src="{{ $academy->logo->url('thumb') }}" alt=" {{ $academy->name }} "></a>
                </div>
            @endforeach
        </div>
        <div class="row ct-u-paddingTop5">
            <div class="col-md-12">
                <h4 class="text-center text-uppercase ct-u-paddingTop30">
                    Estadísticas
                </h4>
            </div>
        </div>
        <div class="row ct-u-paddingTop15 ct-u-paddingBottom15">
            <div class="col-md-offset-1 col-md-2">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-graduation-cap fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $countAcademies }}" data-ct-speed="50">{{ $countAcademies }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Academias
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-male fa-2x"></i>
                        <i class="fa fa-female fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $totalDancers }}" data-ct-speed="50">{{ $totalDancers }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Bailarines
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $totalCompetitors }}" data-ct-speed="50">{{ $totalCompetitors }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Competidores
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $availableCompetitionQuotas }}" data-ct-speed="50">{{ $availableCompetitionQuotas }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Cupos disponibles
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $exceededQuotas }}" data-ct-speed="50">{{ $exceededQuotas }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Cupos en exceso
                        </p>
                    </div>
                </div>
            </div>
        </row>
    </div>
</section>

<section class="ct-u-paddingBottom20 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
    <div class="container">
        <div class="row ct-u-paddingTop5">
            <div class="col-md-12">
                <h4 class="text-center text-uppercase ct-u-paddingTop5">
                    Competidores por categoría
                </h4>
            </div>
        </div>
        @foreach ($competitionCategoriesCount as $category => $levels)
            @foreach ($levels as $level => $genres)
                <div class="row ct-u-paddingTop5">
                    <div class="col-md-offset-4 col-md-4">
                        <h5 class="text-center text-uppercase ct-u-paddingTop5">
                            -- {{ $category }} / {{ $level }} --
                        </h5>
                    </div>
                </div>
                <hr>
                <div class="row ct-u-paddingTop15">
                    <?php
                        switch (count($genres)) {
                             case 1:
                                 $offset = "col-md-offset-4";
                                 $column = "col-md-4";
                             break;
                             case 2:
                                 $offset = "col-md-offset-2";
                                 $column = "col-md-4";
                             break;
                             case 3:
                                 $offset = "";
                                 $column = "col-md-4";
                             break;
                             case 4:
                                 $offset = "";
                                 $column = "col-md-3";
                             break;
                             case 5:
                                 $offset = "col-md-offset-1";
                                 $column = "col-md-2";
                             break;                             
                         } 
                    ?>
                    @foreach ($genres as $gender => $count)
                        <div class="{{ $offset }} {{ $column }}">
                            <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                                <div class="ct-counter-icon">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                                <div class="ct-counter-content">
                                    <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $count }}" data-ct-speed="50">{{ $count }}</span>
                                    <p class="ct-counter-description text-capitalize">
                                        {{ $gender }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>
</section>

<section class="ct-u-paddingBottom20 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
    <div class="container">
        <div class="row ct-u-paddingTop5">
            <div class="col-md-12">
                <h4 class="text-center text-uppercase ct-u-paddingTop5">
                    Pagos
                </h4>
            </div>
        </div>
        <div class="row ct-u-paddingTop15">
            <div class="col-md-offset-2 col-md-4">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $totalPayments }}" data-ct-speed="50">{{ $totalPayments }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Pagos realizados
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $acceptPayments }}" data-ct-speed="50">{{ $acceptPayments }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Pagos Verificados
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ct-u-paddingTop15">
            <div class="col-md-4">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $debt }}" data-ct-speed="50">{{ $totalDebt }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Total
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $credit }}" data-ct-speed="50">{{ $credit }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Ingreso total
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center ct-counterBox-icon"><!-- Counter '2 -->
                    <div class="ct-counter-icon">
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                    <div class="ct-counter-content">
                        <span class="ct-counter-base ct-fw-300 ct-js-counter" data-ct-to="{{ $credit }}" data-ct-speed="50">{{ $debt }}</span>
                        <p class="ct-counter-description text-capitalize">
                            Deuda
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>