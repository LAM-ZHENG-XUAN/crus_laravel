<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project List
        </h2>
    </x-slot>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
    
        header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    
        main {
            margin: 20px auto;
            max-width: 100%; /* Changed from 800px to 100% */
            padding: 0 10px;
        }
    
        table {
            width: 100%; /* Ensures the table takes full width */
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
    
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    
        tr:hover {
            background-color: #f1f1f1;
        }
    
        .url a {
            color: #007bff;
            text-decoration: none;
        }
    
        .url a:hover {
            text-decoration: underline;
        }
    
        .buttons {
            margin: 10px 0;
            text-align: right;
        }
    
        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
    
        button:hover {
            background-color: #0056b3;
        }
    
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
    
            th, td {
                padding: 8px;
            }
    
            button {
                padding: 8px 10px;
                font-size: 12px;
            }
        }
    
        @media (max-width: 480px) {
            table, th, td {
                display: block;
            }
    
            thead {
                display: none;
            }
    
            tr {
                margin-bottom: 10px;
                border-bottom: 1px solid #ddd;
            }
    
            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                font-size: 14px;
            }
    
            td::before {
                content: attr(data-label);
                font-weight: bold;
            }
    
            button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
    
<script>
    function copyRow(button) {
        const row = button.closest('tr');
        let text = '';
        row.querySelectorAll('td').forEach(cell => {
            const cellText = cell.querySelector('a') ? cell.querySelector('a').href : cell.childNodes[0]?.nodeValue.trim();
            text += cellText + '\t';
        });
        navigator.clipboard.writeText(text.trim()).then(() => {
            alert('Selected project attributes copied!');
        });
    }

    function copySpecific(button) {
        const text = button.previousElementSibling?.innerText || button.previousElementSibling?.href;
        navigator.clipboard.writeText(text).then(() => {
            alert('Copied: ' + text);
        });
    }
</script>
<a href="{{ route('projects.create') }}">Add Project</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <div class="col-12">
                            <div class="rol-6">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Category</th>
                                    <th>URL</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </div>
                        <div class="rol-6">
                        <tbody>
                            @foreach ($projects as $project)
                            <tr>
                                <td data-label="Project Name">
                                    {{ $project->project_name }}
                                    <button onclick="copySpecific(this)">Copy</button>
                                </td>
                                <td data-label="Category">
                                    {{ $project->project_cat }}
                                    <button onclick="copySpecific(this)">Copy</button>
                                </td>
                                <td class="url" data-label="URL">
                                    <a href="{{ $project->url }}" target="_blank">{{ $project->url }}</a>
                                    <button onclick="copySpecific(this)">Copy</button>
                                </td>
                                <td data-label="Username">
                                    {{ $project->username }}
                                    <button onclick="copySpecific(this)">Copy</button>
                                </td>
                                <td data-label="Password">
                                    {{ $project->password }}
                                    <button onclick="copySpecific(this)">Copy</button>
                                </td>
                                <td data-label="Actions">
                                    <button onclick="copyRow(this)">Copy All</button>
                                    <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </div>
                    </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
