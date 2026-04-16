<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: #121212;
            color: #e0e0e0;
        }

        .card {
            background-color: #1e1e1e;
            max-width: 500px;
            margin: 80px auto;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
            color: #fff;
            font-size: 28px;
        }

        p {
            font-size: 16px;
            color: #b0b0b0;
        }

        .btn-download {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 28px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 12px;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-download:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(38, 198, 218, 0.5);
        }

        .download-count {
            margin-top: 12px;
            font-size: 16px;
            color: #80cbc4;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="card">
        <h1>Welcome to Dashboard</h1>
        <p>Click the button below to download your PDF:</p>

        <!-- Download Button -->
        <a href="{{ url('/download/test.pdf') }}" class="btn-download">Download PDF</a>

        <!-- Download Count -->
        <div class="download-count">
            Total Downloads: {{ $downloadCount }}
        </div>
    </div>

</body>

</html>