<x-app-layout>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <style>
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}"
        method="POST" class="form-container">
        @csrf
        @if (isset($project))
        @method('PUT')
        @endif
        <label for="name">Project Name:</label>
    <input type="text" id="name" name="name" class="form-control" required>
    
    <label for="category">Category:</label>
    <input type="text" id="category" name="category" class="form-control" required>

    <label for="url">URL:</label>
    <input type="url" id="url" name="url" class="form-control">

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" class="form-control">

    <label for="password">Password:</label>
    <input type="text" id="password" name="password" class="form-control">

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</x-app-layout>

