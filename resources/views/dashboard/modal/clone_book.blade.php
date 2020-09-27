<!-- Modal-->
<div class="modal fade" id="cloneBook" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Book Clone</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="originalBookId" value="">
            <div class="form-group">
						  <label for="cloneBookName">Cloned Book Name:</label>
  						<input class="form-control" type="text" id="cloneBookName">
					  </div>
            <div class="d-none">
              {{-- Circulito de espera --}}
            </div>
            <div class="d-none">
              {{-- Botones para cerrar o ir a la edición del libro --}}
            </div>
          </div>
          <div class="modal-footer">
            <button class="col-lg-3 col-md-3 col-sm-4 btn btn-light-danger font-weight-bold" type="button"  data-dismiss="modal">
              <i class="icon-2x flaticon2-cancel"></i>
              Cancel
            </button>
            <button class="col-lg-4 col-md-4 col-sm-4 btn btn-light-primary font-weight-bold mr-2" type="button" id="cloneBookButton">
              <i class="icon-xl fas fa-clone"></i>
              Clone Book
            </button>
          </div>
        </div>
    </div>
</div>
