<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit User Profile</h1>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Username -->
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">New Password (optional)</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('users.view') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
