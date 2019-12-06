@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 style="display: inline-block;">Create Tenant</h2>
    </div>

    <div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-body role-form">
	                <form method="POST" action="{{ route('createTenant') }}">
	                    {{ csrf_field() }}

	                    <div class="form-group row">
	                        <label class="col-md-12 col-xl-3 text-md-left">{{ __('Domain Name *') }}</label>
	                        <div class="col-md-9 col-xl-4">
	                            <input id="domain" type="text" class="form-control" name="domain" required maxlength="255" placeholder="Enter Domain Name" pattern=".*\S+.*" value="{{ old('domain') }}">
	                        </div>
	                    </div>

	                    <div class="col-md-12 form-group row mb-0">
		                    <div class="col-md-12 mt-md-4 p-0">
		                        <button type="submit" class="btn btn-primary custom-button">
		                            {{ __('SAVE') }}
		                        </button>
		                    </div>
		                </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('javascript')
    <script>
    </script>
@endsection