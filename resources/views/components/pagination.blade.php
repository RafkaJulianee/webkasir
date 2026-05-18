@props(['data'])

@if ($data->hasPages())
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 border-top pt-3">
        <div class="text-muted small mb-2 mb-md-0">
            Menampilkan <strong>{{ $data->firstItem() }}</strong> sampai <strong>{{ $data->lastItem() }}</strong> 
            dari total <strong>{{ $data->total() }}</strong> data
        </div>
        <div class="pagination-container">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endif

<style>
    /* Styling tambahan agar pagination Bootstrap 5 terlihat lebih bersih dan serasi */
    .pagination-container .pagination {
        margin-bottom: 0;
    }
    .pagination-container .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
