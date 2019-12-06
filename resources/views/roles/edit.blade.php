@extends('layouts.app')

@section('content')
    <?php
        $count = DB::table('model_has_roles')
                    ->where('role_id', $roleDetail->id)
                    ->count();

        $checkDelete = ($count > 0) ? false : true;
    ?>

    <div class="mb-4">
        <h2 style="display: inline-block;">Edit Role</h2>
        @if ($checkDelete)
            <a href="{{ route('viewRoleList') }}" class="btn btn-danger float-right mt-0" onclick="showModalDeleteRole('{{ route('deleteRole', $roleDetail->id) }}')">
                Delete
            </a>
        @endif
        <a href="{{ route('viewRoleList') }}" class="btn btn-primary float-right mt-0">
            Back
        </a>
    </div>

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