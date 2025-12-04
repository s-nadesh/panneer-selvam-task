


<form action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($user->exists)
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label" for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name', $user->name)}}">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="profilepic" class="form-label custom-file-input">Choose file</label>
        <input class="form-control" type="file" id="profilepic" name="profilepic">
    </div>

    @if($user->exists && $professional->profilepic)
        <div class="form-group">
            <img src="{{ asset('storage/profile_pics/'.$professional->profilepic) }}" width="150" class="img-thumbnail">
        </div>
    @endif

    <div class="form-group">
        <label class="form-label" for="email">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="email" name="email"  value="{{ old('email', $user->email) }}">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label class="form-label" for="Password">Password:</label>
        <input type="password" class="form-control" id="Password" name="password"  placeholder="Password" value="{{ old('Password', $professional->Password) }}">
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="date_of_birth"> Date of birth</label>
        <input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $professional->date_of_birth) }}">
        @error('date_of_birth')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="address">User address</label>
        <textarea class="form-control" id="address" rows="5" name="address">{{ old('address', $professional->address) }}</textarea>
            @error('address')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label" for="country">country</label>
        <select class="form-select form-select-sm mb-3 shadow-none" id="country" name="country">
            <option selected="">Open this select menu</option>
            <option value="india" {{ old('country', $professional->country) == 'india' ? 'selected' : '' }}>india</option>
            <option value="china" {{ old('country', $professional->country) == 'china' ? 'selected' : '' }}>china</option>
            <option value="cuba" {{ old('country', $professional->country) == 'cuba' ? 'selected' : '' }}>cuba</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label" for="gender">gender</label>
        <select class="form-select form-select-sm mb-3 shadow-none" id="gender" name="gender">
            <option selected="">Open this select menu</option>
            <option value="male" {{ old('gender', $professional->gender) == 'male' ? 'selected' : '' }}>male</option>
            <option value="female" {{ old('gender', $professional->gender) == 'female' ? 'selected' : '' }}>female</option>
            <option value="other" {{ old('gender', $professional->gender) == 'other' ? 'selected' : '' }}>other</option>
        </select>
    </div>

    <button class="btn btn-primary" type="submit">
        {{ $user->exists ? 'Update User' : 'Create User' }}
    </button>
</form>