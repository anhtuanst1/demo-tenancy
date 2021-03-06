@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 style="display: inline-block;">Create Role</h2>
        <a href="{{ route('showListRoles') }}" class="btn btn-primary float-right mt-0">
            Back
        </a>
    </div>

    <div class="row justify-content-center">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-body role-form">
	                <form method="POST" action="{{ route('createRole') }}">
	                    {{ csrf_field() }}

	                    <div class="form-group row">
	                        <label class="col-md-12 col-xl-3 text-md-left">{{ __('Role Name *') }}</label>
	                        <div class="col-md-9 col-xl-4">
	                            <input id="role-name" type="text" class="form-control" name="name" required maxlength="255" placeholder="Enter Role Name" pattern=".*\S+.*" value="{{ old('name') }}">
	                        </div>
	                    </div>

	                    <div class="form-group row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<label class="col-form-label">Select permission for this role</label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										@foreach ($listPermission as $key => $permission)
											<div class="row mb-md-2">
												<div class="col-md-2 col-xl-2">
													<label class="col-form-label">{{ $key + 1 }}- {{ $permission['name'] }}</label>
												</div>
												<div class="col-md-10 col-xl-10 m-auto">
													<div class="row">
														@if ($permission['sub_menu'] == false)
															<label class="col-md-2">
																<input id="select-all-{{$permission['slug']}}" class="role-checkbox" type="checkbox" onClick="sellectAll('{{$permission['slug']}}')"><span class="checkmark"></span> <span>Select All</span>
															</label>
															@foreach ($permission['action'] as $action)
																<label class="col-md-2">
																	<input id="{{ $action['name'] }}" class="role-checkbox cbox-{{$permission['slug']}}" type="checkbox" name="permission[]" value="{{ $action['name'] }}" onClick="toggle('{{$action['name']}}')"><span class="checkmark"></span>
																	<span>
																		<?php
		                                                                    switch (explode("_",$action['name'])[0]) {
		                                                                        case 'browse':
		                                                                            echo 'View';
		                                                                            break;
		                                                                        case 'add':
		                                                                            echo 'Create';
		                                                                            break;
		                                                                        case 'edit':
		                                                                            echo 'Edit';
		                                                                            break;
		                                                                        case 'delete':
		                                                                            echo 'Delete';
		                                                                            break;
		                                                                        default:
		                                                                            break;
		                                                                    }
		                                                                ?>
																	</span>
																</label>
															@endforeach
														@endif
													</div>
												</div>
											</div>
											@if ($permission['sub_menu'] == true)
												@foreach ($permission['list_sub'] as $key => $sub)
													<div class="row">
														<div class="col-md-2 col-xl-2 pl-md-5">
															<label class="mb-md-0">{{ $sub['name'] }}</label>
														</div>
														<div class="col-md-10 col-xl-10">
															<div class="row">
																@if ($sub['name'] != 'Password policy')
																	<label class="col-md-2">
																		<input id="select-all-{{$sub['slug']}}" class="role-checkbox" type="checkbox" onClick="sellectAll('{{$sub['slug']}}')"><span class="checkmark"></span> <span>Select All</span>
																	</label>
																@endif
																@foreach ($sub['action'] as $action)
																	<label class="col-md-2">
																		<input id="{{ $action['name'] }}" class="role-checkbox cbox-{{$sub['slug']}}" type="checkbox" name="permission[]" value="{{ $action['name'] }}" onClick="toggle('{{$action['name']}}')"><span class="checkmark"></span>
																		<span>
																			<?php
			                                                                    switch (explode("_",$action['name'])[0]) {
			                                                                        case 'browse':
			                                                                            echo 'View';
			                                                                            break;
			                                                                        case 'add':
			                                                                            echo 'Create';
			                                                                            break;
			                                                                        case 'edit':
			                                                                            echo 'Edit';
			                                                                            break;
			                                                                        case 'delete':
			                                                                            echo 'Delete';
			                                                                            break;
			                                                                        default:
			                                                                            break;
			                                                                    }
			                                                                ?>
																		</span>
																	</label>
																@endforeach
															</div>
														</div>
													</div>
													@if($key < count($permission['list_sub']) - 1)
														<hr class="mt-md-0 mb-md-0">
													@endif
												@endforeach
											@endif
										@endforeach
									</div>
								</div>
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
		function sellectAll(source) {
			let parents = document.getElementById('select-all-' + source);
			let div = document.getElementsByClassName('cbox-' + source);

			for (var i = 0; i<div.length; i++) {
				div[i].checked = parents.checked;
			}
		}

		function toggle(source) {
			var check_all = 0;
			let parents = document.getElementById(source);

			if(typeof source.split('_')[1] !== 'undefined'){
                if(!parents.checked){
                    let div_sellect_all = document.getElementById('select-all-' + source.split('_')[1]);
                    if(div_sellect_all.checked){div_sellect_all.checked = false;}
                }else{
                    let div_row = document.getElementsByClassName('cbox-' + source.split('_')[1]);
                    for(var j = 0; j<div_row.length; j++){
                        if(div_row[j].checked){check_all++;}
                    }
                    if(check_all == div_row.length){
                        let div_sellect_all = document.getElementById('select-all-' + source.split('_')[1]);
                        if(!div_sellect_all.checked){div_sellect_all.checked = true;}
                    }
                }
            }
		}
    </script>
@endsection