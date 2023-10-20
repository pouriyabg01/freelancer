<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Set the background color for the entire page */
        body {
            background-color: #001f3f; /* Dark blue background */
        }

        /* Center the horizontal profile card */
        .profile-card {
            max-width: 600px;
            margin: 0 auto;
            background-color: #333; /* Darker gray background for the card */
            border-radius: 10px;
            color: #fff;
            display: flex;
            flex-direction: row;
            padding: 20px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }

        .profile-details {
            flex-grow: 1;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .list-group-item {
            font-size: 16px;
            background-color: #444; /* Slightly lighter gray for list items */
        }

        .skill-list {
            font-size: 16px;
            color: #ddd; /* Light gray for skills */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="profile-card card">
        <img src="{{ asset('assets/user.png') }}" alt="User Avatar" class="profile-avatar"> <!-- Placeholder flat image -->
        <div class="profile-details">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Web Developer</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Email: john@example.com</li>
                <li class="list-group-item">Location: New York</li>
            </ul>
            <div class="skill-list">
                <strong>Skills:</strong>
                <ul>
                    @foreach($user->skill()->pluck('name') as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap and JavaScript libraries here -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
