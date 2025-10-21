<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session()->has('success'))
    <script>
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success",
            draggable: true
        });
    </script>
@elseif (session()->has('errors'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            html: `{!! implode('<br>', $errors->all()) !!}`,
        });
    </script>
@endif
