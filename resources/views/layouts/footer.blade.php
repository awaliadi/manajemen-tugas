    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @session('success')
    <script>
        Swal.fire({
        title: "Sukses",
        text: "{{ session('success') }}",
        icon: "success"
    });
    </script>
    @endsession

    @session('error')
    <script>
        Swal.fire({
        title: "Gagal",
        text: "{{ session('error') }}",
        icon: "error"
    });
    </script>
    @endsession


</body>

</html>