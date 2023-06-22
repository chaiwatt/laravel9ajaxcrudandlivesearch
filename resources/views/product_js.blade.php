<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>
<script>
    $(document).ready(function(){
        $(document).on('click','.add_product',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            $.ajax({
                url: "{{ route('add.product') }}",
                method: 'post',
                data:
                {
                    name:name,
                    price:price
                },
                success:function(res)
                {
                    if (res.status == 'success')
                    {
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table-data').html(res.view);
                    }
                },
                error:function(err)
                {

                }
            });
        });

        $(document).on('click','.update_product_form',function(e){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            $('#update_id').val(id)
            $('#update_name').val(name)
            $('#update_price').val(price)
            
        });

        $(document).on('click','.delete_product_form',function(e){
            var productId = $(this).data('id');
            var deleteRoute = $(this).data('delete-route').replace('__id__', productId);
            Swal.fire({
                    icon: 'info',
                    text: 'Confirem to delete',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                            url: deleteRoute,
                            type: 'delete',
                            data:
                            {
                                id:productId
                            },
                            success:function(res)
                            {
                               if (res.status == 'success')
                                {
                                    $('.table-data').html(res.view);
                                }
                               
                            },
                            error:function(err)
                            {

                            }
                        });
                        }
                });
            
        });

        $(document).on('click','.update_product',function(e){
            let id = $('#update_id').val();
            let name = $('#update_name').val();
            let price = $('#update_price').val();
            console.log(id + ' ' +  name + ' ' + price)
            $.ajax({
                url: "{{ route('update.product') }}",
                method: 'post',
                data:
                {
                    id:id,
                    name:name,
                    price:price
                },
                success:function(res)
                {
                    if (res.status == 'success')
                    {
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table-data').html(res.view);
                    }
                },
                error:function(err)
                {

                }
            });
        });

        $(document).on('click','.pagination a',function(e){
            e.preventDefault();
            var search_string = $('#search').val();
            let page = $(this).attr('href').split('page=')[1];
            products(page,search_string)
        });

        function products(page,search_string)
        {
            $.ajax({
                url:"/search-product?page="+page,
                method: "POST",
                data:
                {
                    search_string:search_string
                },
                success:function(res){
                    $('.table-data').html(res);
                }
            });
        }

        $(document).on('keyup', '#search', function () {
            var search_string = $(this).val();
            $.ajax({
                url: "{{ route('search.product') }}",
                method: "POST",
                data:
                {
                    search_string:search_string
                },
                success:function(res)
                {
                    $('.table-data').html(res);
                },
                error:function(err)
                {

                }
            });
        });
    });
</script>