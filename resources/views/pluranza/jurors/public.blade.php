@extends('pluranza.main')

@section('content')
    <section class="ct-u-paddingBottom10 ct-backgroundContent" data-type="color" data-bg-color="#ffffff">
        <div class="container">
            <div class="row ct-u-paddingTop10">
                <div class="col-md-12 ct-titleBox">
                    <h4 class="text-center text-uppercase ct-u-paddingTop30">
                        Jurados Invitados
                    </h4>
                </div>
            </div>
            <div class="row ct-u-paddingTop25">
                <div class="col-md-10">
                    @role(['admin'])
                        <a href="{{ route('pluranza.jurors.home') }}" class="ct-js-btnScroll btn btn-sm btn-danger btn-circle pull-right">Agregar</a>
                    @endroute
                </div>
            </div>            
        </div>
        <div class="container">
            <div class="row ct-u-paddingTop30">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ct-artisticBox">
                                <div class="ct-artisticBox-content">
                                    <div class="ct-backgroundContent" data-bg-color="#f7f7f7" data-type="color">
                                        <div class="ct-artisticBox-description">
                                            <h3 class="ct-artisticBox-date">2014 - 2015</h3>
                                            <h4 class="ct-artisticBox-title text-uppercase">Artistic Staff</h4>
                                            <ul class="list-unstyled ct-artistBox-members">
                                                <li>Karen Jenkins - <a href="staff.html#">Ballet Master</a></li>
                                                <li>Lisa Donalds - <a href="staff.html">Ballet Mistress</a></li>
                                                <li>Dana Johnsons - <a href="staff.html#">Rehearsal Director</a></li>
                                                <li>Melissa Kens - <a href="staff.html#">Artistic Director</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ct-artisticBox-left ct-artisticBox-personImage">
                                    @foreach ($jurors as $jury)
                                    <a href="{{ route ('pluranza.jurors.show', $jury->id) }}" class="ct-personBox ct-personBox--primary ct-js-btnScroll">
                                        <figure class="ct-personBox-image">
                                            <img src="{{ $jury->photo->url('public') }}" alt="{{ $jury->fullName }}">
                                            <figcaption>
                                            <div class="ct-personBox-name">{{ $jury->fullName }}</div>
                                            <span class="ct-personBox-linkHelper">Ver</span>
                                            </figcaption>
                                        </figure>
                                    </a>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop