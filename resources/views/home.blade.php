@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 style="display: inline-block;">List Users</h2>
        <a href="javascript:void(0);" class="btn btn-primary float-right mt-0" onclick="showModalCreateUser()">
            Create User
        </a>
    </div>

    <table id="users-table" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th class="w-5">Id</th>
                <th class="w-20">Name</th>
                <th class="w-25">Email</th>
                <th>Role</th>
                <th class="w-5">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listUsers as $user)
                <tr>
                    <td class="content">
                        {{ $user->id }}
                    </td>
                    <td class="content">
                        {{ $user->name }}
                    </td>
                    <td class="content">
                        {{ $user->email }}
                    </td>
                    <td>
                        <form action="" method="POST">
                            @csrf
                            <select id="list-roles" class="w-50" name="role" required>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="text-danger" onclick="showModalDeleteUser('{{ route('deleteUser', $user->id) }}')">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- create user modal -->
    <div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTitle">{{ __('Create User') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('createUser') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus pattern=".*\S+.*">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" pattern=".*\S+.*">

                                <input id="password-confirm" type="hidden" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel-modal" data-dismiss="modal">{{ __('CANCEL') }}</button>
                        <button type="submit" class="btn btn-primary btn-create-modal">{{ __('CREATE') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete user modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTitle">{{ __('Delete User') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this user?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel-modal" data-dismiss="modal">{{ __('CANCEL') }}</button>
                    <form id="delete-form" action="" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-delete-modal">{{ __('DELETE') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function showModalCreateUser() {
            $('#modalCreateUser').modal('show');
        }

        function showModalDeleteUser(urlDelete) {
            $('#delete-form').attr('action', urlDelete);
            $('#modalDelete').modal('show');
        }

        $('input#password').change(function(){
            $('input#password-confirm').val($('input#password').val());
        })
    </script>
@endsection