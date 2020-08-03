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
      <button type="button" class="delete-section btn bnt-error float-right d-none">
        <span class="oi oi-circle-x" title="circle-x" aria-hidden="true"></span>
      </button>
    </h5>
  </div>

  <div id="collapse1" class="card-body-container" aria-labelledby="heading1" data-parent="#Sections">

    <div class="card-body">

      <div class="title-block">
        <input type="hidden" class="section-index" value="1">

        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input addSectionTitle" id="addHeader1">
          <label class="custom-control-label" for="addHeader1">Add a section title</label>
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

{{--
      <button type="button" value="Add" class="btn btn-success mt-3 upload_files">
        <span class="oi oi-cloud-upload" title="cloud-upload" aria-hidden="true"></span>
        Upload images
      </button>
 --}}
      <div class="row mt-2">
        <div class="col">
          <button type="button" class="btn btn-danger delete-images" name="button" disabled="disabled">Delete all images</button>
        </div>
        <div class="col">
{{--
          <div class="float-right">
            <input type="checkbox" class="orderByName" id="orderByName1" name="orderByName" value="1" checked="checked"> Order images by name
          </div>
--}}
        </div>
      </div>
    </div>

  </div>

</li>
