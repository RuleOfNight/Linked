<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('/css/profile-edit.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div>
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio">{{ $user->bio }}</textarea>
            </div>

            <div>
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate ? $user->birthdate->format('Y-m-d') : '') }}">
            </div>

            <div>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div>
                <label for="avatar">Avatar:</label>
                <input type="file" id="avatar" name="avatar">
                @if($user->profile_picture)
                    <div class="current-avatar-container">
                        <p>Current Avatar:</p>
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Current Avatar">
                    </div>
                @endif
            </div>

            <div id="social-links-container">
                <label>Social Links:</label>
                @php
                    $sociallinks = $sociallinks ?? []; // Đảm bảo $sociallinks là một mảng
                @endphp
                @if(count($sociallinks) > 0)
                    @foreach ($sociallinks as $index => $sociallink)
                        <div class="social-link-group">
                            <label for="social_links[{{ $index }}][link_text]">Link Text:</label>
                            <input type="text" name="social_links[{{ $index }}][link_text]" value="{{ $sociallink->link_text }}" required>
                            <label for="social_links[{{ $index }}][link_url]">Link URL:</label>
                            <input type="url" name="social_links[{{ $index }}][link_url]" value="{{ $sociallink->link_url }}" required>
                            <button type="button" class="remove-social-link">Remove</button>
                        </div>
                    @endforeach
                @else
                    <div class="social-link-group">
                        <label for="social_links[0][link_text]">Link Text:</label>
                        <input type="text" name="social_links[0][link_text]" required>
                        <label for="social_links[0][link_url]">Link URL:</label>
                        <input type="url" name="social_links[0][link_url]" required>
                        <button type="button" class="remove-social-link">Remove</button>
                    </div>
                @endif
            </div>

            <div class="buttons">
                <button type="submit">Update Profile</button>
                <button type="button" id="add-social-link">Add Social Link</button>
                <a href="{{ route('home') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-social-link').addEventListener('click', function() {
            console.log('đuawadwadawdaw')
            // event -> server
            const container = document.getElementById('social-links-container');
            const index = container.querySelectorAll('.social-link-group').length;
            const newGroup = document.createElement('div');
            newGroup.classList.add('social-link-group');
            newGroup.innerHTML = `
                <label for="social_links[${index}][link_text]">Link Text:</label>
                <input type="text" name="social_links[${index}][link_text]" required>
                <label for="social_links[${index}][link_url]">Link URL:</label>
                <input type="url" name="social_links[${index}][link_url]" required>
                <button type="button" class="remove-social-link">Remove</button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('social-links-container').addEventListener('click', function(event) {
            console.log('sssssssssssss')
            if (event.target.classList.contains('remove-social-link')) {
                event.target.closest('.social-link-group').remove();
            }
        });
    </script>
</body>
</html>