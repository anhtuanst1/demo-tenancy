@extends('layouts.app')

@section('content')
    <h2>List Users</h2>
    <br>
    <table id="users-table" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th class="w-5">Id</th>
                <th class="w-20">Name</th>
                <th class="w-30">Email</th>
                <th>Role</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('javascript')
    <script>
    </script>
@endsection