@extends('layouts.app')

@section('content')
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column">
                <h4 class="ui top attached blue header">
                    <i class="fa fa-user"></i>
                    Update informations
                </h4>
                <div class="ui bottom attached segment" style="overflow: hidden">
                    {{ Form::open(['url' => route('profile.update')]) }}
                    <div class="ui form">
                        <div class="field">
                            <label>
                                Full name
                            </label>
                            {!! Form::text('fullname', $profile->fullname) !!}
                        </div>
                        <div class="field">
                            <label>
                                Birth date
                            </label>
                            {!! Form::select('birthdate') !!}
                        </div>
                        <div class="field">
                            <label>
                                Location
                            </label>
                            {!! Form::text('location', $profile->location) !!}
                        </div>
                        <div class="field">
                            <label>
                                About
                            </label>
                            {!! Form::textarea('about', $profile->about, ['rows' => 3]) !!}
                        </div>
                        <button class="ui right floated primary labeled icon button">
                            <i class="fa-save icon"></i>
                            Send
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection