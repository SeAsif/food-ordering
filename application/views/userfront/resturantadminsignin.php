<?
// $this->load->view("userfront/header_view");
$this->load->view("userfront/header_view_new");

?>

<div class="main-container">
    <div class="row justify-content-cetner">
        <div class="col-12 p-0">
            <div aria-label="breadcrumb ">
                <ol class="breadcrumb sign_in pt-3 MB-3">
                    <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url() ?>home">Home</a></li>
                    <li class="breadcrumb-item active"><span>Resturant Sign Up</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="grid_row sign_in mb-5">
        <form action="" method="post">
            <div></div>
            <div class="card mb-0 mt-0">
                <div class="card-header">
                    <h5>Resturant Admin Sign Up</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="resturantname" class="form-label">Resturant Name</label>
                        <input type="text" name="resturantname" class="form-control" id="resturantname" aria-describedby="emailHelp">
                        <!-- <div id="new_email_address" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="totalemployees" class="form-label">Total Employees</label>
                        <input type="number" name="totalemployees" min="0" class="form-control" id="totalemployees" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="ownerfirstname" class="form-label">Resturant Owner First Name</label>
                        <input type="text" name="ownerfirstname" min="0" class="form-control" id="ownerfirstname" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="ownerlastname" class="form-label">Resturant Owner Last Name</label>
                        <input type="text" name="ownerlastname" min="0" class="form-control" id="ownerlastname" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="ownerpassword" class="form-label">Resturant Owner Password</label>
                        <input type="password" name="ownerpassword" min="0" class="form-control" id="ownerpassword" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="ownerphone" class="form-label">Resturant Owner Phone</label>
                        <input type="tel" name="ownerphone" min="0" class="form-control" id="ownerphone" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="owneremail" class="form-label">Resturant Owner Email</label>
                        <input type="email" name="owneremail" min="0" class="form-control" id="owneremail" aria-describedby="emailHelp">
                        <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <input name="btn" type="submit" class="btn btn-primary text-white" value="Create Account" />
                </div>
            </div>
        </form>
    </div>
</div>
<?
$this->load->view("userfront/footer_view");
?>