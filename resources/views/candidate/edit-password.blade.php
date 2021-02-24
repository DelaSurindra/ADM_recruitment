<h2 class="candidate-page-title">Edit Password</h2>
<div class="row mt-4">
    <div class="col-lg-7 col-md-12">
        <form action="" class="form-candidate-view pt-4">
            <div class="form-group">
                <label for="">Old Password</label>
                <div class="row">
                    <div class="col-lg-11 col-md-12 with-icon">
                        <input type="text" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter Old Password">
                        <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon" alt="icon">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <div class="row">
                    <div class="col-lg-11 col-md-12 with-icon">
                        <input type="text" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password">
                        <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon" alt="icon">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">New Password Confirmation</label>
                <div class="row">
                    <div class="col-lg-11 col-md-12 with-icon">
                        <input type="text" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Enter New Password">
                        <img src="{{ asset('image/icon/homepage/icon-eye.svg') }}" class="this-icon" alt="icon">
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="row">
                    <div class="col-lg-11 col-md-12">
                        <button class="btn btn-red btn-block">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>