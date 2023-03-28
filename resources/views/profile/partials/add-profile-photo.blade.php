<h2 class="text-lg font-medium text-gray-900">
    {{ __('Photo') }}
</h2>

<p class="mt-1 mb-5 text-sm text-gray-600">
    {{ __("Update or add photo to your profile.") }}
</p>
{{-- displat photo --}}
@if (Auth::user()->photo==null)
    <img class="mb-3" width="100px" src="img/user-null.png"  alt="">
    @else
    <img class='rounded' class="mb-3" width="100px" src="uploads/{{Auth::user()->photo}}"  alt="">
@endif


<form action="{{ route('upload.photo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo">
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3 mb-3" type="submit">Upload Photo</button>
</form>
@if (session('success'))
    <div >
        {{ session('success') }}
    </div>
@endif
