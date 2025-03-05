

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('Admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('Admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('Admin/js/sb-admin-2.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function()
        {
            // PAGINATION
            $(document).on('click','.pagination a',function(e){
                e.preventDefault();
                let page= $(this).attr('href').split('page=')[1]
                expeditions(page);
            });
            function expeditions(page){
                $.ajax({
                    url:"pagination/pagination-data?page="+page,
                    success:function(res){
                        $('.table-data').html(res);
                    },
                });
            }
    
    // SEARCHHH 

        $(document).on('keyup',function(e) {
            e.preventDefault();

            let search_string= $('#search').val();

            $.ajax({
            type:'GET',
            url:"{{ route('admin.search') }}",
            data:{search_string:search_string},
            success:function(res)
            {
               $('.table-data').html(res);

               if(res.status=='Inexistant'){
                $('.table-data').html('<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Aucun resultats Trouvé</div></div>');
               }
            }
        });

        })
            
    });
    </script>
    <!-- Page level plugins -->
    <script src="{{asset('Admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('Admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('Admin/js/demo/chart-pie-demo.js')}}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>