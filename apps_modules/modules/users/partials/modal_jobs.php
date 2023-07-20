 <!-- Modal -->
 <div class="modal fade" id="edit-jobModal" tabindex="-1" aria-labelledby="edit-jobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md overflow-hidden">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card border-0">
                    <div class="row g-3">
                        <div class="col-6 bg-light rounded-3">
                            <div class="row">
                                <img id="product-detail-img" class="ratio ratio-4x3" src="" alt="" srcset="">
                            </div>
                            <div class="row g-2">
                                <div class="col rounded-3 ">
                                    <img class="ratio ratio-4x3" src="" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 rounded-3">
                            <div class="card h-100 border-0">
                                <div class="card-header bg-transparent border-0 ">
                                    <div class="d-flex flex-row mb-4">
                                        <div class="d-flex flex-column">
                                            <span id="product-detail-name" class="text-black fw-semi fs-16"></span>
                                            <span id="product-detail-cat" class="text-muted"></span>
                                        </div>
                                        <div class="ms-auto">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mb-4 flex-column d-flex overflow-y-scroll" style="max-height:350px">
                                    <span id="product-detail-desc" class="text-break text-pre-wrap text-black fs-12 mb-4">
                                    </span>
                                    <span class="text-prussianblue fw-semi fs-18" data-currency="" id="product-detail-price"></span>
                                    <span class="text-prussianblue fw-semi fs-18 d-none" id="product-detail-table">
                                        <table id="" class="table table-muted table-striped table-hover">
                                            <thead>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </span>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <div class="mt-4 d-flex flex-row">
                                        <img src="" alt="">
                                        <div class="flex-column d-flex">
                                            <span class="text-prussianblue fw-bold fs-16" id="product-detail-seller"></span>
                                            <span class="text-muted" id="product-detail-location"></span>
                                        </div>
                                        <button class="btn btn-danger ms-auto px-3 py-1 align-self-center d-flex">Contact Seller</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="del-jobModal" tabindex="-1" aria-labelledby="del-jobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm overflow-hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Are you sure to delete this Job ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" name="items-id" value="" id="job-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Yes">
            </div>
        </div>
    </div>
</div>

