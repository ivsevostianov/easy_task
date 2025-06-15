<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { background: rgba(255,255,255,0.95); border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .btn-primary { background: linear-gradient(45deg, #667eea, #764ba2); border: none; }
        .btn-primary:hover { background: linear-gradient(45deg, #764ba2, #667eea); transform: translateY(-2px); }
        .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25); }
        h1 { color: #333; text-shadow: 2px 2px 4px rgba(0,0,0,0.1); }
        .btn { transition: all 0.3s ease; }
        .btn:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="container mt-5 p-5">
        <div class="text-center mb-5">
            <h1><i class="fas fa-edit me-3"></i>Edit Item</h1>
            <p class="text-muted">Update your item details</p>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <form action="{{ route('items.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" 
                                   value="{{ $item->name }}" required>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Update Item
                        </button>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
