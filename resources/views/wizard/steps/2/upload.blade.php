<ul id="Sections" class="sections-list vertical">

</ul>

<input type="hidden" id="section-last-index" name="section-last-index" value="0">

<button type="button" name="button" class="btn btn-primary btn-lg btn-block" id="addSection">
  <span class="oi oi-plus" title="plus" aria-hidden="true"></span>
  Add new section
</button>

<li class="section-template d-none card">

  <div class="card-header" id="heading1">
    <h5 class="mb-0">
      <span class="oi oi-ellipses"></span>
      <button class="btn btn-link section-button">
        Section 1
      </button>
      <span class="section-error text-white d-none"> (Number of images and solutions does not match!)</span>
      <button type="button" class="delete-section btn bnt-error float-right d-none">
        <span class="oi oi-circle-x" title="circle-x" aria-hidden="true"></span>
      </button>
    </h5>
  </div>

  <div id="collapse1" class="card-body-container" aria-labelledby="heading1" data-parent="#Sections">

    <div class="card-body">
      {{-- Whole Section content--}}
      <div class="section-content">
        <div class="title-block">
          <input type="hidden" class="section-index" value="1">

          <div class="row">
            <div class="col-2 mb-3">
              <label class="imagesPerPageLabel text-muted" for="imagesPerPage1">Images per page:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <span class="oi oi-grid-two-up"></span>
                  </div>
                </div>
                <select class="custom-select imagesPerPage text-right" id="imagesPerPage1">
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="4">4</option>
                  <option value="6">6</option>
                  <option value="12">12</option>
                </select>
              </div>
            </div>
            <div class="col">

            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="custom-control custom-switch">
                <div class="row">
                  <div class="col">
                    <input type="checkbox" class="custom-control-input addSectionTitle" id="addHeader1">
                    <label class="custom-control-label addHeaderLabel" for="addHeader1">Add a section title</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="custom-control custom-switch">
                <div class="row">
                  <div class="col">
                    <input type="checkbox" class="custom-control-input imageNameAsTitle" id="addImageNameAsTitle1">
                    <label class="custom-control-label imageNameAsTitleLabel" for="addImageNameAsTitle1">Add file name as image title</label>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="d-none section-title-text">
            <input type="text" class="form-control section-title-input" id="sectionTitle1" aria-describedby="Header text" maxlength="60" placeholder="Section title">
              <input type="checkbox" id="addTitleHeader1" class="addTitleHeader" value="1" checked="checked"> Add title to the section pages header.
          </div>
        </div>


        <div class="dropzone dz-clickable myDrop" id="myDrop1">
          <div class="dz-default dz-message" data-dz-message="">
              <span>Click here or Drop files to upload</span>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col">
            <button type="button" class="btn btn-danger delete-images" name="button" disabled="disabled">Delete all images</button>
          </div>
          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <input type="checkbox" class="custom-control-input addSolutions" id="addSolutions1">
                  <label class="custom-control-label addSolutionsLabel" for="addSolutions1">Is it a puzzle with solutions section?</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End of Whole Section content--}}
    {{-- Whole Section solutions content--}}
    <div class="card-footer solutions-content mt-2 d-none">
      <div class="solutions-title-block">
        <div class="alert alert-primary text-center" role="alert">
          -- Solutions --
        </div>

        <div class="row">
          <div class="col-2 mb-3">
            <label class="solutionsPerPageLabel text-muted" for="solutionsPerPage1">Solutions per page:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="oi oi-grid-two-up"></span>
                </div>
              </div>
              <select class="custom-select solutionsPerPage text-right" id="solutionsPerPage1">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="12">12</option>
              </select>
            </div>
          </div>
          <div class="col">

          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <input type="checkbox" class="custom-control-input addSolutionTitle" id="addHeaderSolution1">
                  <label class="custom-control-label addHeaderSolutionLabel" for="addHeaderSolution1">Add a solutions section title</label>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <input type="checkbox" class="custom-control-input imageNameAsTitleSolution" id="addImageNameAsTitleSolution1">
                  <label class="custom-control-label imageNameAsTitleLabelSolution" for="addImageNameAsTitleSolution1">Add file name as solution title</label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-none section-title-text">
          <input type="text" class="form-control section-title-solutions-input" id="sectionTitleSolution1" aria-describedby="Header text" maxlength="60" placeholder="Solutions title">
            <input type="checkbox" id="addTitleHeaderSolution1" class="addTitleHeaderSolution" value="1" checked="checked"> Add title to the solution pages header.
        </div>
      </div>


      <div class="dropzone dz-clickable myDrop dropzone-solutions" id="myDropSolutions1">
        <div class="dz-default dz-message" data-dz-message="">
            <span>Click here or Drop files to upload the <em>Solutions</em></span>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col">
          <button type="button" class="btn btn-danger delete-solutions" name="button" disabled="disabled">Delete all solutions</button>
        </div>
        <div class="col">
          <div class="custom-control custom-switch">
            <div class="row">
              <div class="col">
                <input type="checkbox" class="custom-control-input placeSolutionsAtTheEnd" id="solutionsAtTheEnd1">
                <label class="custom-control-label placeSolutionsAtTheEndLabel" for="solutionsAtTheEnd1">Place solutions at the end of the book</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- End of Whole Section solutions content--}}
  </div>

</li>
