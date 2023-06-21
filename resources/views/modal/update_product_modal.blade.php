<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="POST" id="updateProductForm">
        @csrf
        <input type="text" id="update_id" hidden>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer">

                    </div>
                    <div class="from-group">
                        <label for="update_name">Product Name</label>
                        <input type="text" class="form-control" name="update_name" id="update_name">
                    </div>
                    <div class="from-group mt-2">
                        <label for="update_price">Price</label>
                        <input type="text" class="form-control" name="update_price" id="update_price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_product">Save Change</button>
                </div>
            </div>
        </div>
    </form>
</div>