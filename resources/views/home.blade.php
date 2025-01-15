<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Listing</title>
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
            max-width: 800px;
            padding: 0 10px;
        }

        table {
            width: 100%;
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
</head>
<body>
    <header>
        <h1>Project Listing</h1>
    </header>

    <main>
        <table>
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
            <tbody>
                <tr>
                    <td data-label="Project Name">
                        Project Alpha
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Category">
                        Web Development
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td class="url" data-label="URL">
                        <a href="https://example.com" target="_blank">example.com</a>
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Username">
                        alpha_user
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Password">
                        alpha_pass
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Actions">
                        <button onclick="copyRow(this)">Copy All</button>
                    </td>
                </tr>
                <tr>
                    <td data-label="Project Name">
                        Project Beta
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Category">
                        Mobile App
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td class="url" data-label="URL">
                        <a href="https://beta.com" target="_blank">beta.com</a>
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Username">
                        beta_user
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Password">
                        beta_pass
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Actions">
                        <button onclick="copyRow(this)">Copy All</button>
                    </td>
                </tr>
                <tr>
                    <td data-label="Project Name">
                        Project Gamma
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Category">
                        Data Analysis
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td class="url" data-label="URL">
                        <a href="https://gamma.com" target="_blank">gamma.com</a>
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Username">
                        gamma_user
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Password">
                        gamma_pass
                        <button onclick="copySpecific(this)">Copy</button>
                    </td>
                    <td data-label="Actions">
                        <button onclick="copyRow(this)">Copy All</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>
