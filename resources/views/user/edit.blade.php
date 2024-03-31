@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
</script>

<script type="text/javascript">
    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $(".uploads").change(readURL)
        $("#f").submit(function() {
            // do ajax submit or just classic form submit
            //  alert("fake subminting")
            return false
        })
    })
</script>
@stop

@extends('layouts.app')

@section('content')

<form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Data User <b>{{$data->name}}</b> </h4>
                            <form class="forms-sample">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('ktp_no') ? ' has-error' : '' }}">
                                    <label for="ktp_no" class="col-md-4 control-label">ID Card</label>
                                    <div class="col-md-6">
                                        <input id="ktp_no" type="number" class="form-control" name="ktp_no" value="{{ $data->ktp_no }}" required>
                                        @if ($errors->has('ktp_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ktp_no') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
                                    <div class="col-md-6">
                                        <input id="phone_number" type="number" class="form-control" name="phone_number" value="{{ $data->phone_number }}" required>
                                        @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">email</label>
                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="email" value="{{ $data->email }}" required>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('addres') ? ' has-error' : '' }}">
                                    <label for="addres" class="col-md-4 control-label">Address</label>
                                    <div class="col-md-6">
                                        <input id="addres" type="text" class="form-control" name="addres" value="{{ $data->addres }}" required>
                                        @if ($errors->has('addres'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('addres') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="submit">
                                    Update
                                </button>
                                <a href="{{route('user.index')}}" class="btn btn-light pull-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
