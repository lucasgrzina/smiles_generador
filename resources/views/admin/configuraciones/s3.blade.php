@extends('layouts.app')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('admin/crud/css/cu.css') }}"/>
@endsection

@section('scripts')
    @parent
    <!--script src="https://unpkg.com/vuejs-datepicker"></script-->
    <script type="text/javascript" src="{{ asset('vendor/vee-validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/crud/js/cu.js') }}"></script>

    <script type="text/javascript">
        //Vue.component('datepicker', vuejsDatepicker);
        var _data = {!! json_encode($data) !!};
        console.debug(_data);
    </script>
@endsection

@section('content-header')
    {!! AdminHelper::contentHeader('Credenciales S3','Configuraciones',false) !!}
@endsection

@section('content')
    @include('admin.components.switches')
    <div class="content">
        <div class="box box-default box-cu">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-6" :class="{'has-error': errors.has('AMAZON_S3_KEY')}">
                        {!! Form::label('AMAZON_S3_KEY', 'AMAZON_S3_KEY*') !!}
                        {!! Form::text('AMAZON_S3_KEY', null, ['class' => 'form-control','v-model' => 'selectedItem.AMAZON_S3_KEY','v-validate' => "'required'",'data-vv-validate-on' => 'none']) !!}
                        <span class="help-block" v-show="errors.has('AMAZON_S3_KEY')">(% errors.first('AMAZON_S3_KEY') %)</span>
                    </div>
                    
                    <div class="form-group col-sm-6" :class="{'has-error': errors.has('AMAZON_S3_SECRET')}">
                        {!! Form::label('AMAZON_S3_SECRET', 'AMAZON_S3_SECRET*') !!}
                        {!! Form::text('AMAZON_S3_SECRET', null, ['class' => 'form-control','v-model' => 'selectedItem.AMAZON_S3_SECRET','v-validate' => "'required'",'data-vv-validate-on' => 'none']) !!}
                        <span class="help-block" v-show="errors.has('AMAZON_S3_SECRET')">(% errors.first('AMAZON_S3_SECRET') %)</span>
                    </div>                        
                </div>
            </div>
            <div class="box-footer text-right">
                <button-type type="save" :promise="store"></button-type>
            </div>            
        </div>    
    </div>
@endsection