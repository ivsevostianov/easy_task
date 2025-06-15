<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { background: rgba(255,255,255,0.95); border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .btn-primary { background: linear-gradient(45deg, #667eea, #764ba2); border: none; }
        .btn-primary:hover { background: linear-gradient(45deg, #764ba2, #667eea); transform: translateY(-2px); }
        .table th { background: linear-gradient(45deg, #667eea, #764ba2); color: white; }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
        h1 { color: #333; text-shadow: 2px 2px 4px rgba(0,0,0,0.1); }
        .btn { transition: all 0.3s ease; }
        .btn:hover { transform: translateY(-2px); }
        .alert { border: none; border-radius: 15px; }
    </style>
</head>
<body>
    <div class="container mt-5 p-5">
        <div class="text-center mb-5">
            <h1><i class="fas fa-box-open me-3"></i>Items Manager</h1>
            <p class="text-muted">Manage your items with style</p>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-plus-circle me-2"></i>Add New Item</h5>
                <form action="{{ route('items.store') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter item name" required>
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-plus me-2"></i>Add Item
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-list me-2"></i>Items List</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                <th><i class="fas fa-tag me-2"></i>Item Name</th>
                                <th><i class="fas fa-calendar me-2"></i>Created</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td><span class="badge bg-primary">{{ $item->id }}</span></td>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td><small class="text-muted">{{ $item->created_at->format('M d, Y') }}</small></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('items.show', $item) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('items.destroy', $item) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No items found. Add your first item above!</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="fas fa-docker me-1"></i>Powered by Docker LAMP Stack
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
