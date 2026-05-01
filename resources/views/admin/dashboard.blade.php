<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f0f2f5; 
            padding: 30px; 
            color: #333;
        }
        .container { max-width: 1100px; margin: 0 auto; }
        .box { 
            background: #fff; 
            padding: 25px; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); 
            margin-bottom: 30px; 
        }
        h2 { 
            margin-top: 0; 
            font-size: 22px; 
            color: #007bff; 
            border-bottom: 2px solid #eef2f7; 
            padding-bottom: 15px; 
            margin-bottom: 20px;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px; text-align: left; border-bottom: 1px solid #edf2f7; }
        th { background: #f8f9fa; font-weight: 600; color: #495057; }
        tr:hover { background: #fcfdfe; }
        
        .form-group { display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 10px; }
        input { 
            flex: 1; 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            outline: none;
        }
        input:focus { border-color: #007bff; }
        
        .btn { 
            padding: 10px 20px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-weight: 600; 
            text-decoration: none;
            font-size: 14px;
        }
        .btn-add { background: #28a745; color: white; }
        .btn-add:hover { background: #218838; }
        .btn-delete { background: #dc3545; color: white; padding: 6px 12px; }
        .btn-delete:hover { background: #c82333; }
        
        .alert { 
            padding: 12px; 
            border-radius: 6px; 
            margin-bottom: 20px; 
            font-size: 14px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            background: #e9ecef;
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="box">
        <h2>Add New User</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn btn-add">Create User</button>
            </div>
        </form>
    </div>

    <div class="box">
        <h2>Registered Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td><span class="badge">#{{ $u->id }}</span></td>
                    <td><strong>{{ $u->name }}</strong></td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                    <td>
                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        <h2>Download Statistics</h2>
        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Total Downloads</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($downloads as $d)
                <tr>
                    <td><code>{{ $d->file_name }}</code></td>
                    <td><strong>{{ $d->count }}</strong></td>
                    <td>{{ $d->updated_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box">
        <h2>Recent Activities</h2>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Activity</th>
                    <th>IP Address</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $a)
                <tr>
                    <td>{{ $a->user_id ?? 'Guest' }}</td>
                    <td>{{ $a->activity }}</td>
                    <td><small>{{ $a->ip_address }}</small></td>
                    <td>{{ $a->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>