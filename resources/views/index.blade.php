<x-layout>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row g-4">

        {{-- FORM --}}
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/profile">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label fw-semibold">Age</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror"
                                id="age" name="age" min="1" max="120" value="{{ old('age') }}">
                            @error('age') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="program" class="form-label fw-semibold">Program</label>
                            <input type="text" class="form-control @error('program') is-invalid @enderror"
                                id="program" name="program" value="{{ old('program') }}">
                            @error('program') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Gender</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="male" value="Male"
                                        {{ old('gender', 'Male') == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender"
                                        id="female" value="Female"
                                        {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            @error('gender') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Hobbies <small class="text-muted">(select at least 5)</small>
                            </label>
                            @php
                                $hobbyList = ['Reading','Gaming','Coding','Drawing','Music','Cooking','Sports','Photography','Traveling','Writing'];
                                $oldHobbies = old('hobbies', []);
                            @endphp
                            <div class="row row-cols-2 g-1">
                                @foreach($hobbyList as $hobby)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="hobbies[]" value="{{ $hobby }}"
                                            id="hobby_{{ $loop->index }}"
                                            {{ in_array($hobby, $oldHobbies) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="hobby_{{ $loop->index }}">
                                            {{ $hobby }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @error('hobbies') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biography" class="form-label fw-semibold">Short Biography</label>
                            <textarea class="form-control" id="biography" name="biography" rows="3">{{ old('biography') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- PROFILES --}}
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Generated Profiles</h5>
                    <span class="badge bg-light text-dark">{{ count($profiles) }}</span>
                </div>
                <div class="card-body">

                    @if(count($profiles) > 0)
                        <form method="POST" action="/profile/clear" class="mb-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100"
                                onclick="return confirm('Delete all profiles?')">
                                Delete All Profiles
                            </button>
                        </form>

                        @foreach(array_reverse($profiles) as $profile)
                            <x-profile-card :profile="$profile" />
                        @endforeach
                    @else
                        <p class="text-muted text-center py-4">No profiles yet. Fill in the form to get started.</p>
                    @endif

                </div>
            </div>
        </div>

    </div>

</x-layout>
