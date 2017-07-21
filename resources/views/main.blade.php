@extends('dashboard::layouts.dashboard')
@section('title',$name)
@section('description',$description)
@section('navbar')
    <div class="col-sm-6 col-xs-12 text-right">
        <div class="btn-group" role="group">
            <a href="{{ route('dashboard.remote.{remote}.create',$service['route'])}}" class="btn btn-link"><i
                        class="icon-plus fa fa-2x"></i></a>
        </div>
    </div>
@stop
@section('content')
    @if(count($data['data']) > 0)
        <section class="wrapper">
            <div class="bg-white-only  bg-auto no-border-xs">

                <div class="panel-body row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="w-xs">{{trans('dashboard::common.Manage')}}</th>
                                @foreach($data['data'][0] as $key => $datum)
                                    @if($key != $slug)
                                        <th>{{$behaviors[$key]['title']}}</th>
                                    @endif
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['data'] as $key => $datum)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{
                                        route('dashboard.remote.{remote}.edit', [
                                            $service['service']. '-'. $service['route'],
                                            $datum[$slug]
                                        ])}}">
                                            <i class="fa fa-bars"></i></a>
                                    </td>
                                    @foreach($datum as $key => $value)
                                        @if($key != $slug)
                                            <td>
                                                {{$value}}
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8">
                                <small class="text-muted inline m-t-sm m-b-sm">{{trans('dashboard::common.show')}} {{$data['total']}}
                                    -{{$data['per_page']}} {{trans('dashboard::common.of')}} {!! $data['total'] !!} {{trans('dashboard::common.elements')}}</small>
                            </div>
                            <div class="col-sm-4 text-right text-center-xs">
                               <nav aria-label="...">
                                  <ul class="pager">

                                    <li><a href="#"><span aria-hidden="true">&larr;</span> Назад</a></li>
                                    <li><a href="#"><span aria-hidden="true">&rarr;</span> Вперёд</a></li>

                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
        </section>
    @else
        <section class="wrapper">
            <div class="bg-white-only bg-auto no-border-xs">


                <div class="jumbotron text-center bg-white not-found">
                    <div>
                        <h3 class="font-thin">{{trans('dashboard::post/general.not_found')}}</h3>
                        <a href="{{ route('dashboard.remote.{remote}.create',$service['route'])}}"
                           class="btn btn-link">{{trans('dashboard::post/general.create')}}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@stop
