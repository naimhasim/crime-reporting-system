  <!--AddReportModal -->
<div class="modal fade" id="AddReportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST" id="addreportform" enctype="multipart/form-data">
    <div class="modal-dialog">

        <div class="modal-content">  {{-- modal content --}}
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body"> {{-- modal body --}}
                <ul id="reportform_errList"></ul>

                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Your Name</label>
                    <input type="text" class="form-control fullname" placeholder="Enter Title">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                    <input type="text" class="form-control phoneno" placeholder="Enter Title">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input type="email" class="form-control email" placeholder="name@example.com">
                </div>
                <div class="px-1 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Report title</label>
                    <input type="text" class="form-control report_title" placeholder="What does report is about?">
                </div>

                <div class="px-1 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">What is happening?</label>
                    <textarea class="form-control report_desc" id="exampleFormControlTextarea1" rows="3" placeholder="In-depth explanation..."></textarea>
                  </div>

                <label for="formFile" class="form-label">Crime Category</label>
                <div class="input-group px-1 mb-3">

                    <select class="form-select crime_category" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Housebreak">Housebreak</option>
                        <option value="Robbery">Robbery</option>
                        <option value="Theft">Theft</option>
                        <option value="Motor vehicle theft">Motor Vehicle Theft</option>
                        <option value="Assault">Assault</option>
                    </select>
                </div>
                <div class="px-1 mb-3">
                    <label for="formFile" class="form-label">Upload photo</label>
                    <input class="form-control report_media" type="file" id="inputGroupFile02">
                </div>
                <div class="px-1 mb-3">
                    <label for="formFile" class="form-label">Date occured</label>
                    <input class="form-control crimedate" type="date">
                </div>

                <label for="exampleFormControlInput1" class="form-label">Location</label>
                <div class="map-container">
                    <div id="markermapid" class="map" ></div>
                </div>

                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Latitude&nbsp;&nbsp;&nbsp;</span>
                    <input id="latitude" type="text" class="form-control latitude" placeholder="Drag marker" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Longitude</span>
                    <input id="longitude" type="text" class="form-control longitude" placeholder="in map" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div> {{--modal body--}}

            <div class="modal-footer"> {{-- modal footer --}}
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add_report">Save</button>
            </div>
        </div> {{-- modal content -- end --}}
    </div>
    </form>
  </div>



