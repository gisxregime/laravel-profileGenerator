<div class="card mb-3 border">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h6 class="card-title fw-bold mb-1">{{ $profile->name }}</h6>
                <span class="badge bg-primary me-1">{{ $profile->program }}</span>
                <span class="badge {{ $profile->gender === 'Male' ? 'bg-info' : 'bg-danger' }}">
                    {{ $profile->gender }}
                </span>
            </div>
        </div>
        <hr class="my-2">
        <p class="mb-1 small"><strong>Age:</strong> {{ $profile->age }}</p>
        <p class="mb-1 small"><strong>Email:</strong> {{ $profile->email }}</p>
        <p class="mb-1 small"><strong>Hobbies:</strong> {{ implode(', ', $profile->hobbies ?? []) }}</p>
        @if(!empty($profile->biography))
            <p class="mb-0 small"><strong>Bio:</strong> {{ $profile->biography }}</p>
        @endif
    </div>
</div>
