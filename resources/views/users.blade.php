@extends('layouts.app')

@section('content')
    @if (session('success'))
        <center>
            <span class='inline-block p-4 text-white font-bold bg-yellow-400 rounded mt-4'>{{ session('success') }}</span>
        </center>
    @endif

    <form action="{{ route('search.sort') }}" method="get">
        @csrf
        <div class="flex">
            <div class="search">
                <button class="bg-gray-800 hover:bg-gray-700 text-white p-2 rounded" type="submit">search</button>
                <input class=" w-75 rounded" placeholder="search users name" type="text" name="search"
                    value="@isset($search)
                {{ $search }}
            @endisset" />
            </div>

            <div class="sort flex">
                <select onchange=' this.form.submit();' name="sort" class="sort_box sort-box rounded">
                    <option value="Oldest"
                        @isset($sort)
                    @if ($sort == 'Oldest')
                        selected
                    @endif
                @endisset>
                        Oldest</option>
                    <option value="Newest"
                        @isset($sort)
                @if ($sort == 'Newest')
                    selected
                @endif
            @endisset>
                        Newest</option>
                </select>
            </div>
        </div>
    </form>

    <table class=' mt-4'>

        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Opration</th>

            </tr>
        </thead>
        <tbody>
            @empty($users)
                <tr>
                    <td colspan="5">No users found</td>
                </tr>
            @else
                @foreach ($users as $user)
                    @if ($user->deleted_at == null)
                        <tr>
                            {{-- usesr photo --}}
                            <td>
                                @isset($user->photo)
                                    <img class="user-img" src="{{ asset('uploads/' . $user->photo) }}" alt="">
                                @else
                                    <img class="user-img" src="{{ asset('img/user.png') }}" alt="">
                                @endisset
                            </td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }} </td>

                            <td>{{ $user->password }} </td>

                            <td>
                                @foreach ($roles as $role)
                                    @if ($role->id == $user->role_id)
                                        {{ $role->name }}
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                @if (Auth::user()->id != $user->id)
                                    <div class="operation">
                                        @if ($user->status == 1)
                                            {{-- ban button --}}
                                            <form action=" {{ route('ban.user') }}" method="POST">
                                                @csrf
                                                <button name="ban" type="submit"
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded "
                                                    value="{{ $user->id }}">Ban</button>
                                            </form>
                                        @else
                                            {{-- Unban button --}}
                                            <form action=" {{ route('Unban.user') }}" method="POST">
                                                @csrf

                                                <button name="Unban" type="submit"
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded "
                                                    value="{{ $user->id }}">UnBan</button>
                                            </form>
                                        @endif
                                        {{-- edit button --}}
                                        <form action="{{ route('show_edit.user') }}" method="get">
                                            @csrf
                                            <button name="edit" type="submit"
                                                class="bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded ml-1 "
                                                value="{{ $user->id }}">edit</button>
                                        </form>
                                        {{-- delete button --}}
                                        <form action=" {{ route('delete.user') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button name="delete" type="submit"
                                                class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded ml-1 "
                                                value="{{ $user->id }}">Delete</button>
                                        </form>

                                        {{-- role changer --}}
                                        <form action="{{ route('change.role') }} " method="POST">
                                            @csrf
                                            <div class="role_style">
                                                <select class="select-box" name="user_role" id="">
                                                    @foreach ($roles as $role)
                                                        @unless($role->id == $user->role_id)
                                                            <option value="{{ $role->id }}-{{ $user->id }}">
                                                                {{ $role->name }} </option>
                                                        @endunless
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                    class="bg-blue-600 hover:bg-blue-800  text-white font-bold py-2 px-4 rounded ml-1 ">Change</button>
                                            </div>
                                        </form>

                                    </div>
                                @else
                                    No operation for this user
                                @endif

                            </td>

                        </tr>
                    @endif
                @endforeach
            @endempty

        </tbody>
    </table>

@endsection
