@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2 style="display: inline-block;">List Roles</h2>
        @can('add_role')
            <a href="{{ route('viewCreateRole') }}" class="btn btn-primary float-right mt-0">
                Create Role
            </a>
        @endcan
    </div>

    <table id="users-table" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th class="w-5">Id</th>
                <th class="w-20">Name</th>
                <th class="w-5">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listRoles as $role)
                <?php
                    $count = DB::table('model_has_roles')
                                ->where('role_id', $role->id)
                                ->count();

                    $checkDelete = ($count > 0) ? false : true;
                ?>
                <tr>
                    <td class="content">
                        {{ $role->id }}
                    </td>
                    <td class="content">
                        <a href="{{ route('viewEditRole', $role->id) }}" class="btn-link">
                            {{ ucwords($role->name) }}
                        </a>
                    </td>
                    <td>
                        @can('delete_role')
                            @if ($checkDelete)
                                <a href="javascript:void(0);" class="text-danger" onclick="showModalDeleteRole('{{ route('deleteRole', $role->id) }}')">
                                    Delete
                                </a>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- delete role modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="deleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTitle">{{ __('Delete Role') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this role?') }}
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
        function showModalDeleteRole(urlDelete) {
            $('#delete-form').attr('action', urlDelete);
            $('#modalDelete').modal('show');
        }
    </script>
@endsection