<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Project List
        </h2>
    </x-slot>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha384-oPu2k4s0FQKjxR3PIm0KcHuiYPXJlANB62jrpESlDvFpSyvLt0D8M/V9KuN8X" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <style>
        body {
            background: #f0f4f8;
            font-family: 'Poppins', sans-serif;
        }

        .big-card {
            width: 100%;
            max-width: 650px;
            margin: 1.5rem auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            margin: 5px;
        }

        .drag-handle {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: move;
            font-size: 1.2rem;
            color: #888;
        }

    </style>
    <script>
        function copySpecific(button) {
            const parent = button.parentNode;
            const sibling = parent.querySelector('a') || parent.querySelector('span');
            let textToCopy = sibling ? sibling.textContent.trim() : '';
            navigator.clipboard.writeText(textToCopy).then(() => alert('Copied: ' + textToCopy));
        }

        function copyRow(button) {
            const cardBody = button.closest('.card-body');

            // Collect the <h5> text and pair each <strong> with its corresponding <span> and <a>
            const texts = Array.from(cardBody.querySelectorAll('h5, p')).map(p => {
                const strong = p.querySelector('strong');
                const span = p.querySelector('span');
                const anchor = p.querySelector('a');

                if (strong && span && anchor) {
                    return strong.textContent + span.textContent.trim();
                } else if (strong && span) {
                    return strong.textContent + span.textContent.trim();
                } else if (strong && anchor) {
                    return strong.textContent + anchor.textContent.trim();
                } else if (strong) {
                    return strong.textContent;
                } else if (span) {
                    return span.textContent.trim();
                } else if (anchor) {
                    return anchor.textContent.trim();
                }

                return p.textContent.trim();
            });

            navigator.clipboard.writeText(texts.join('\n')).then(() => alert('All project attributes copied!'));
        }

        const reorderUrl = "{{ route('projects.reorder') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        document.addEventListener('DOMContentLoaded', () => {
    const projectList = document.getElementById('project-list');

    if (projectList) {
        Sortable.create(projectList, {
            animation: 150,
            handle: '.drag-handle',
            onEnd: () => {
                const order = Array.from(projectList.children).map((child, index) => ({
                    id: child.querySelector('.big-card').dataset.id,
                    order: index + 1 // Assign the new order based on the current position
                }));

                // Send the updated order to the server
                fetch('{{ route('projects.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ order }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Projects reordered successfully!');
                        // Optionally refresh the page or update the UI dynamically
                    } else {
                        alert('Failed to reorder projects.');
                    }
                })
                .catch(error => console.error('Error:', error));
            },
        });
    }
});


        document.addEventListener('DOMContentLoaded', () => {
            $(".btn-delete").click(function () {
                return confirm("Are you sure you want to delete?");
            });
        });

    </script>
    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary float-end">Add Project</a>
                    <div class="row" id="project-list">
                        @foreach ($projects as $project)
                        <div class="col-md-6 mb-4">
                            <div class="card big-card" data-id="{{ $project->id }}">
                                <i class="drag-handle bi bi-grip-horizontal"></i>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $project->name }}
                                    </h5>
                                    <p class="d-flex">
                                        <strong>Category:</strong>
                                        <span style="margin-left: 0.5rem;">{{ $project->category }}</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <strong>URL:</strong>
                                        <a class="flex-grow-1"
                                            href="{{ $project->url }}"><span style="margin-left: 0.5rem;">{{ $project->url }}</span></a>
                                        <button onclick="copySpecific(this)" class="btn btn-sm btn-secondary ms-2">
                                            <i class="bi bi-copy"></i>
                                        </button>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <strong>Username:</strong>
                                        <span class="flex-grow-1" style="margin-left: 0.5rem;">{{ $project->username }}</span>
                                        <button onclick="copySpecific(this)" class="btn btn-sm btn-secondary ms-2">
                                            <i class="bi bi-copy"></i>
                                        </button>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <strong>Password:</strong>
                                        <span class="flex-grow-1" style="margin-left: 0.5rem;">{{ $project->password }}</span>
                                        <button onclick="copySpecific(this)" class="btn btn-sm btn-secondary ms-2">
                                            <i class="bi bi-copy"></i>
                                        </button>
                                    </p>
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                            class="btn btn-link">Edit</a>
                                        <button onclick="copyRow(this)" class="btn btn-info">Copy All</button>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
