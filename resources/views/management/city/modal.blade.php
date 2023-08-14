<!-- resources/views/provinces/index.blade.php -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Province Form -->
                <form id="createCityForm">
                    <div class="form-group">
                        <label for="city_code">City Code</label>
                        <input type="text" class="form-control" id="city_code" name="city_code">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City Name</label>
                        <input type="text" class="form-control" id="city_name" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="province_id">Province Code</label>
                        <select class="form-control" id="province_id" name="province_id">
                            <option value="">Select Province Code</option>
                            <!-- Populate options dynamically using JavaScript or Blade -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCityButton">Save</button>
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
                <h5 class="modal-title" id="editModalLabel">Edit City</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCityForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_city_code">City Code</label>
                        <input type="text" class="form-control" id="edit_city_code" name="city_code">
                    </div>
                    <div class="form-group">
                        <label for="edit_city_name">City Name</label>
                        <input type="text" class="form-control" id="edit_city_name" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="edit_province_id">Province Code</label>
                        <select class="form-control" id="edit_province_id" name="province_id">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveEditCityButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">City Details</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="detail_id">ID</label>
                    <input type="text" class="form-control" id="detail_id" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_city_code">City Code</label>
                    <input type="text" class="form-control" id="detail_city_code" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_city_name">City Name</label>
                    <input type="text" class="form-control" id="detail_city_name" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_province_code">Province Code</label>
                    <input type="text" class="form-control" id="detail_province_code" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_province_name">Province Name</label>
                    <input type="text" class="form-control" id="detail_province_name" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
