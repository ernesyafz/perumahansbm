<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cluster - SBM Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #F4F7F9; font-family: 'Inter', sans-serif; }
        .main-card { max-width: 1000px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h3>Edit Cluster</h3>
                <p class="text-muted mb-0">Perbarui data unit dan gambar landing page.</p>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">Kembali</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm main-card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.clusters.update', $cluster) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Cluster</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $cluster->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tipe</label>
                            <input type="text" name="type" class="form-control" value="{{ old('type', $cluster->type) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $cluster->price) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Luas Tanah (m²)</label>
                            <input type="number" name="land_area" class="form-control" value="{{ old('land_area', $cluster->land_area) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Luas Bangunan (m²)</label>
                            <input type="number" name="building_area" class="form-control" value="{{ old('building_area', $cluster->building_area) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kamar Tidur</label>
                            <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $cluster->bedrooms) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kamar Mandi</label>
                            <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $cluster->bathrooms) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Carport</label>
                            <input type="number" name="carport" class="form-control" value="{{ old('carport', $cluster->carport) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id', $cluster->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- KODE INI SUDAH DIREVISI (Menghapus URL dan Memperlebar Upload) -->
                        <div class="col-12">
                            <label class="form-label">Upload Gambar Baru <span class="text-muted fw-normal">(Biarkan kosong jika tidak ingin mengubah gambar saat ini)</span></label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $cluster->description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ringkasan Fitur</label>
                            <textarea name="feature_summary" class="form-control" rows="2">{{ old('feature_summary', $cluster->feature_summary) }}</textarea>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>