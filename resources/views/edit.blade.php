@extends('dashboard::layouts.dashboard')
@section('title',$name)
@section('description',$description)
@section('navbar')
    <div class="col-md-6 no-padder text-right">
        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <button type="submit" form="post-form" class="btn btn-link"><i class="icon-check fa fa-2x"></i></button>
            <button type="submit" form="form-post-remove" class="btn btn-link"><i class="icon-trash  fa fa-2x"></i>
            </button>
        </div>
    </div>
@stop
@section('content')
    <div class="app-content-body app-content-full" id="post">
        @if (count($errors) > 0)
            <div class="alert alert-danger m-n">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    <!-- hbox layout  -->
        <form class="hbox hbox-auto-xs bg-light"
              id="post-form"
              method="post"
              action="{{route('dashboard.remote.{remote}.store', [
                        $service['service']. '-'. $service['route'],
                        $data[$slug],
              ])}}"
              enctype="multipart/form-data">

                <!-- column  -->
                <div class="col lter b-r">
                    <div class="vbox">
                        <div class="bg-white">
                            <div class="container">
                                <div class="wrapper-xl bg-white">
                                      {!!  \Orchid\Remote\RemoteService::generateForm($behaviors,$data) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /column  -->

            {{ csrf_field() }}
        </form>
        <!-- /hbox layout  -->
    </div>
    <form id="form-post-remove"
          action="{{route('dashboard.remote.{remote}.destroy', [
                        $service['service']. '-'. $service['route'],
                        $data[$slug],
              ])}}"
          method="POST">
            {{ csrf_field() }}
        {{ method_field('delete') }}
        </form>
@stop
