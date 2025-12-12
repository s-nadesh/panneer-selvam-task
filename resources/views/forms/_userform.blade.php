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

    @if($user->exists && !empty($professional->profilepic))
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

    @if(!$user->exists)
    <div class="form-group">
        <label class="form-label" for="Password">Password:</label>
        <input type="password" class="form-control" id="Password" name="password"  placeholder="Password" value="{{ old('Password', $professional->Password) }}">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    @endif

    <div class="form-group">
        <label for="date_of_birth"> Date of birth</label>
        <input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', optional($professional)->date_of_birth) }}">
        
    </div>

    <div class="form-group">
        <label class="form-label" for="address">User address</label>
        <textarea class="form-control" id="address" rows="5" name="address">{{ old('address', optional($professional)->address) }}</textarea>
            
    </div>

    <div class="form-group">
        <label class="form-label" for="country">country</label>
        <select class="form-select form-select-sm mb-3 shadow-none" id="country" name="country">
            <option selected="">Open this select menu</option>
            <option value="india" {{ old('country', optional($professional)->country) == 'india' ? 'selected' : '' }}>india</option>
            <option value="china" {{ old('country', optional($professional)->country) == 'china' ? 'selected' : '' }}>china</option>
            <option value="cuba" {{ old('country', optional($professional)->country) == 'cuba' ? 'selected' : '' }}>cuba</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label" for="gender">gender</label>
        <select class="form-select form-select-sm mb-3 shadow-none" id="gender" name="gender" required>
            <option selected="">Open this select menu</option>
            <option value="male" {{ old('gender', optional($professional)->gender) == 'male' ? 'selected' : '' }}>male</option>
            <option value="female" {{ old('gender', optional($professional)->gender) == 'female' ? 'selected' : '' }}>female</option>
            <option value="other" {{ old('gender', optional($professional)->gender) == 'other' ? 'selected' : '' }}>other</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label" for="gender">Roles</label>

        <select name="role" class="form-control">
            <option value="">-- Select role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary" type="submit">
        {{ $user->exists ? 'Update User' : 'Create User' }}
    </button>
</form>