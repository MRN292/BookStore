@extends('layouts.app')

@section('content')
    <table>
        <thead>
            <tr>
                <th>profile img</th>
                <th>name</th>
                <th>email</th>
                <th>password</th>
                <th>opration</th>

            </tr>
        </thead>
        <tbody>
            @empty($users)
                <tr>
                    <td colspan="5">No users found</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->photo == null)
                            <img class="user-img" src="img/user.png" alt="">
                            @else
                                <img class="user-img" src="uploads/{{ Auth::user()->photo }}" alt="">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }} </td>
                        <td>{{ $user->password }} </td>
                        <td>
                            @if (Auth::user()->id != $user->id)
                                <div class="operation">
                                    @if ($user->status == 1)
                                        {{-- ban button --}}
                                        <form action=" {{ route('ban.user', $user->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            <button type="submit"
                                                class="bg-gray-900 text-white font-bold py-2 px-4 rounded ">Ban</button>
                                        </form>
                                    @else
                                        {{-- Unban button --}}
                                        <form action=" {{ route('Unban.user', $user->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <button type="submit"
                                                class="bg-gray-900 text-white font-bold py-2 px-4 rounded ">UnBan</button>
                                        </form>
                                    @endif
                                    {{-- edite button --}}
                                    <form action="{{ route('show_edit.user', $user->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        <button type="submit"
                                            class="bg-gray-900 text-white font-bold py-2 px-4 rounded ml-1 ">edit</button>
                                    </form>
                                    {{-- delete button --}}
                                    <form action=" {{ route('delete.user', $user->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-gray-900 text-white font-bold py-2 px-4 rounded ml-1 ">Delete</button>
                                    </form>

                                </div>
                            @else
                                No operation for this user
                            @endif

                        </td>

                    </tr>
                @endforeach
            @endempty

        </tbody>
    </table>
@endsection
