<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity Updates Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .record {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .record p {
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <h2>Activity Updates Report</h2>

    @foreach($updates as $update)
        <div class="record">
            <p><strong>Activity:</strong> {{ $update->activity->title }}</p>
            <p><strong>Status:</strong> {{ ucfirst($update->status) }}</p>
            <p><strong>Remark:</strong> {{ $update->remark }}</p>
            <p><strong>Bio Snapshot:</strong> {{ $update->bio_snapshot }}</p>
            <p><strong>Date:</strong> {{ $update->created_at->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach

</body>
</html>
