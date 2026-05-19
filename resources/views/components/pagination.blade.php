@props(['data'])

@if ($data->hasPages())
    <div class="d-flex justify-content-end mt-3 border-top pt-3">
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
    /* Sembunyikan teks summary bawaan Laravel pada Bootstrap 5 pagination */
    .pagination-container p.small.text-muted {
        display: none !important;
    }
    /* Mengatur ul pagination agar berada di kanan jika flex-container default laravel masih ada */
    .pagination-container > div.d-sm-flex {
        justify-content: flex-end !important;
    }
    .pagination-container > nav > div.d-sm-flex > div:first-child {
        display: none !important;
    }
</style>
