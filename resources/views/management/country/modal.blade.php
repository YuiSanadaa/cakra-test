<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Country</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
            </div>
            <div class="modal-body">
                <form id="createForm">
                    <div class="mb-3">
                        <label for="country-code" class="col-form-label">Country Code:</label>
                        <input type="text" maxlength="10" class="form-control" id="country_code" name="country_code"
                            id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="country-name" class="col-form-label">Country Name:</label>
                        <input type="text" maxlength="60" class="form-control" name="country_name" id="country_name"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="createButton" onclick="alert('Are u sure wanna create this data ?')"
                    class="btn btn-primary">Save Data</button>
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
                <h5 class="modal-title" id="editModalLabel">Edit Country</h5>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="form-group">
                        <label for="edit_country_code">Country Code</label>
                        <input type="text" class="form-control" id="edit_country_code" name="edit_country_code">
                    </div>
                    <div class="form-group">
                        <label for="edit_country_name">Country Name</label>
                        <input type="text" class="form-control" id="edit_country_name" name="edit_country_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditButton">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Country Details</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="detail_id">ID</label>
                    <input type="text" class="form-control" id="detail_id" readonly>
                </div>
                <div class="form-group">
                    <label for="detail_country_code">Country Code</label>
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
