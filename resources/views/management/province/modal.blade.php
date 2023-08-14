<!-- resources/views/provinces/index.blade.php -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Province</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Province Form -->
                <form id="createProvinceForm">
                    <div class="form-group">
                        <label for="province_code">Province Code</label>
                        <input type="text" class="form-control" id="province_code" name="province_code">
                    </div>
                    <div class="form-group">
                        <label for="province_name">Province Name</label>
                        <input type="text" class="form-control" id="province_name" name="province_name">
                    </div>
                    <div class="form-group">
                        <label for="country_id">Country Code</label>
                        <select class="form-control" id="country_id" name="country_id">
                            <option value="">Select Country Code</option>
                            <!-- Populate options dynamically using JavaScript or Blade -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveProvinceButton">Save</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success</h5>
            </div>
            <div class="modal-body">
                Success Create Data! Closing in <span id="countdown"></span> seconds.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Province</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProvinceForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_province_code">Province Code</label>
                        <input type="text" class="form-control" id="edit_province_code" name="province_code">
                    </div>
                    <div class="form-group">
                        <label for="edit_province_name">Province Name</label>
                        <input type="text" class="form-control" id="edit_province_name" name="province_name">
                    </div>
                    <div class="form-group">
                        <label for="edit_country_id">Country Code</label>
                        <select class="form-control" id="edit_country_id" name="country_id">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveEditProvinceButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Province</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="detail_id">ID</label>
                    <input type="text" class="form-control" id="detail_id" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_country_code">Province Code</label>
                    <input type="text" class="form-control" id="detail_province_code" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_country_">Province Name</label>
                    <input type="text" class="form-control" id="detail_province_name" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_country_name">Country Code</label>
                    <input type="text" class="form-control" id="detail_country_code" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_country_name">Country Name</label>
                    <input type="text" class="form-control" id="detail_country_name" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
