<!-- add/edit form modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit <i class="bx bx-edit" aria-hidden="true"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addform" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Barang:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="bx bx-box" aria-hidden="true"></i>
            </div>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Harga Beli:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="bx bx-purchase-tag" aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required="required">
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Harga Jual:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="bx bxs-purchase-tag" aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required="required" maxLength="10" minLength="10">
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Stok:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="bx bx-check" aria-hidden="true"></i></span>
            </div>
            <input type="number" class="form-control" id="stok" name="stok" required="required" maxLength="10" minLength="10">
          </div>
          </div>
          <div class="form-group">
          <label for="message-text" class="col-form-label">Photo Barang:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01"><i class="bx bx-photo-album" aria-hidden="true"></i></span>
            </div>
            <div class="custom-file">
            <input type="file" class="custom-file-input" name="photo" id="userphoto" >
            <label class="custom-file-label" for="userphoto">Choose file</label>
            </div>
            </div>

          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" id="addButton">Submit</button>
        <input type="hidden" name="action" value="adduser">
        <input type="hidden" name="userid" id="userid" value="adduser">
      </div>
      </form>
    </div>
  </div>
</div>
<!-- add/edit form modal end -->