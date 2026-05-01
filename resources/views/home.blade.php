<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: #121212;
            color: #e0e0e0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background-color: #1e1e1e;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #fff;
            font-size: 32px;
        }

        .file-list {
            margin-top: 30px;
            text-align: left;
        }

        .file-item {
            background: #2c2c2c;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s;
        }

        .file-item:hover {
            background: #333;
        }

        .file-info {
            display: flex;
            flex-direction: column;
        }

        .file-name {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .download-count {
            font-size: 14px;
            color: #80cbc4;
            margin-top: 5px;
        }

        .btn-download {
            padding: 10px 24px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 117, 252, 0.4);
        }

        .admin-link {
            display: block;
            margin-top: 40px;
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .admin-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1>File Downloads</h1>
            <p>Select a file from the list below to download:</p>

            <div class="file-list">
                @foreach($files as $file)
                    <div class="file-item">
                        <div class="file-info">
                            <span class="file-name">{{ $file['name'] }}</span>
                            <span class="download-count">Total Downloads: {{ $file['count'] }}</span>
                        </div>
                        <a href="{{ url('/download/' . $file['name']) }}" class="btn-download dl-trigger">Download</a>
                    </div>
                @endforeach
            </div>

            <a href="{{ url('/admin/dashboard') }}" class="admin-link">Access Admin Dashboard</a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.dl-trigger').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'File Processing',
                    text: 'Your download is starting now.',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false,
                    background: '#1e1e1e',
                    color: '#fff'
                });
            });
        });
    </script>

</body>
</html>