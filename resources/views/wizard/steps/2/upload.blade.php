<ul id="Sections" class="sections-list vertical">

</ul>

<input type="hidden" id="section-last-index" name="section-last-index" value="0">

<button type="button" name="button" class="btn btn-info btn-lg btn-block font-weight-bold" id="addSection">
  <span class="icon-2x text-light-info flaticon-layers" title="plus" aria-hidden="true"></span>
  Add new section
</button>

<li class="section-template d-none card">

  <div class="card-header p-1 bg-light-primary" id="heading1">
    <h5 class="mb-0">
      <span class="flaticon-more"></span>
      <button class="btn btn-link section-button font-weight-bolder font-size-lg">
        Section 1
      </button>
      <span class="section-error label label-danger label-inline font-weight-lighter mr-2 d-none"> (Number of images and solutions does not match!)</span>
      <button type="button" class="delete-section btn bnt-error float-right d-none">
        <span class="flaticon-cancel" title="circle-x" aria-hidden="true"></span>
      </button>
    </h5>
  </div>

  <div id="collapse1" class="card-body-container" aria-labelledby="heading1" data-parent="#Sections">

    <div class="card-body p-0">
      <input type="hidden" class="section-id" value="">
      <input type="hidden" class="section-index" value="1">

      <div class="title-block section-options p-5 d-none" style="box-shadow: inset 0px 0px 10px rgba(0,0,0,0.5);">

        <div class="row">

          <div class="col-2 mb-3">
            <label class="imagesPerPageLabel text-muted" for="imagesPerPage1">Images per page:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="text-primary flaticon-squares"></span>
                </div>
              </div>
              <select class="custom-select imagesPerPage text-right" id="imagesPerPage1">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="12">12</option>
                <option value="24">24</option>
              </select>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Add a section title:</label>
                  <span class="switch switch-outline switch-icon switch-primary">
                    <label>
                      <input type="checkbox" class="custom-control-input addSectionTitle" id="addHeader1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Set file name as image title:</label>
                  <span class="switch switch-outline switch-icon switch-primary">
                    <label>
                      <input type="checkbox" class="custom-control-input imageNameAsTitle" id="addImageNameAsTitle1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Is it a puzzle with solutions section?</label>
                  <span class="switch switch-outline switch-icon switch-primary">
                    <label>
                      <input type="checkbox" class="custom-control-input addSolutions" id="addSolutions1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="d-none section-title-text mt-2">
          <input type="text" class="form-control section-title-input" id="sectionTitle1" aria-describedby="Header text" maxlength="60" placeholder="Section title">
          <div class="row mt-2">
            <div class="col">
              <label class="addTitleHeaderLabel text-muted">Add title as:</label>
              <br>
              <div class="btn-group btn-group-toggle toggle-primary section-title-as" data-toggle="buttons">
                <label class="btn btn-outline-secondary">
                  <input type="radio" name="options" id="option1" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.PAGE') }}"> Section 1st page
                </label>
                <label class="btn btn-outline-secondary">
                  <input type="radio" name="options" id="option2" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.HEADER') }}"> Section header
                </label>
                <label class="btn btn-outline-secondary active">
                  <input type="radio" name="options" id="option3" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}" checked> 1st page & header
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button class="btn btn-light btn-shadow btn-hover-primary rounded-top-0 text-dark-75 ml-5 font-weight-bolder font-size-lg toggleSectionOptions" type="button" name="button">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Settings-1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
          </g>
          </svg><!--end::Svg Icon-->
        </span>
        Section Options
      </button>

      {{-- Whole Section content--}}
      <div class="section-content p-5 mt-5">
        <div class="row">
          <div class="col-9">
            <div class="dropzone dropzone-default dz-clickable myDrop" id="myDrop1">
              <div class="dz-default dz-message" data-dz-message="">
                  <h3 class="dropzone-msg-title">Drop files here or click to upload</h3>
                  <span class="dropzone-msg-desc">You can upload any .jpg, .gif or .png image up to <strong>5MB</strong> </span>
              </div>
            </div>
          </div>
          <div class="col-3 d-flex flex-column justify-content-between">
            <button type="button" class="btn btn-info btn-lg font-weight-bold loadLibraryContentButton" name="button"  data-toggle="modal" data-target="#loadContentFromLibrary">
              <i class="icon-xl fas fa-box-open"></i>
              Bookstrap Content
            </button>
            <button type="button" class="btn btn-danger btn-sm delete-images font-weight-bold" name="button" disabled="disabled">
              <i class="icon-xl text-light-danger fas fa-eraser"></i>
              Delete content
            </button>
          </div>
        </div>
      </div>

    </div>
    {{-- End of Whole Section content--}}

    {{-- Whole Section solutions content--}}
    <div class="card-footer solutions-content mt-2 d-none bg-light-success p-2" style="box-shadow: inset 0px 0px 10px rgba(0,0,0,0.5);">

      <div class="alert alert-success text-light-success text-center font-weight-bolder font-size-lg rounded-bottom-0 mb-0" role="alert">
        -- Solutions --
      </div>

      <div class="solutions-title-block solutions-options border-bottom p-5  bg-white d-none" style="box-shadow: inset 0px 0px 10px rgba(0,0,0,0.5);">
        <div class="row">

          <div class="col-2 mb-3">
            <label class="solutionsPerPageLabel text-muted" for="solutionsPerPage1">Solutions per page:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="text-success flaticon-squares"></span>
                </div>
              </div>
              <select class="custom-select solutionsPerPage text-right" id="solutionsPerPage1">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="12">12</option>
                <option value="24">24</option>    
              </select>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Add a solutions section title:</label>
                  <span class="switch switch-outline switch-icon switch-success">
                    <label>
                      <input type="checkbox" class="custom-control-input addSolutionTitle" id="addHeaderSolution1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Add file name as solution title:</label>
                  <span class="switch switch-outline switch-icon switch-success">
                    <label>
                      <input type="checkbox" class="custom-control-input imageNameAsTitleSolution" id="addImageNameAsTitleSolution1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="custom-control custom-switch">
              <div class="row">
                <div class="col">
                  <label class="addTitleLabel text-muted">Place solutions at the end:</label>
                  <span class="switch switch-outline switch-icon switch-success">
                    <label>
                      <input type="checkbox" class="custom-control-input placeSolutionsAtTheEnd" id="solutionsAtTheEnd1" name="select"/>
                      <span></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="d-none section-title-text">
          <input type="text" class="form-control section-title-solutions-input" id="sectionTitleSolution1" aria-describedby="Header text" maxlength="60" placeholder="Solutions title">
          <label class="addTitleHeaderSolutionLabel text-muted">Add solutions title as:</label>
          <br>
          <div class="btn-group btn-group-toggle toggle-success solutions-title-as" data-toggle="buttons">
            <label class="btn btn-outline-secondary">
              <input type="radio" name="options" id="option1" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.PAGE') }}"> Solutions 1st page
            </label>
            <label class="btn btn-outline-secondary">
              <input type="radio" name="options" id="option2" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.HEADER') }}"> Solutions header
            </label>
            <label class="btn btn-outline-secondary active">
              <input type="radio" name="options" id="option3" autocomplete="off" value="{{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}" checked> 1st page & header
            </label>
          </div>
        </div>

      </div>

      <button class="btn btn-light btn-shadow btn-hover-success rounded-top-0 text-dark-75 ml-5 font-weight-bolder font-size-lg toggleSolutionsOptions" type="button" name="button">
        <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Settings-1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
            <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
          </g>
          </svg><!--end::Svg Icon-->
        </span>
        Solutions Options
      </button>

      <div class="solutions-body p-5 mt-5">
        <div class="row">
          <div class="col-9">
            <div class="dropzone dropzone-default dropzone-success dz-clickable myDrop dropzone-solutions" id="myDropSolutions1">
              <div class="dz-default dz-message" data-dz-message="">
                <h3 class="dropzone-msg-title">Drop files here or click to upload the <strong>Solutions</strong></h3>
                <span class="dropzone-msg-desc"></span>
              </div>
            </div>
          </div>
          <div class="col-3 d-flex flex-column justify-content-end">
            <button type="button" class="btn btn-danger delete-solutions" name="button" disabled="disabled">
              <i class="icon-xl text-light-danger fas fa-eraser"></i>
              Delete all solutions
            </button>
          </div>
        </div>
      </div>

    </div>
    {{-- End of Whole Section solutions content--}}

  </div>

</li>

<div id="progress-container" class="d-none block-ui progress-ui">
  <div class="progress w-200">
      <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
</div>
