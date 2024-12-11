

<div class="modal fade" id="exampleModalCenterSignin" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #ff8a00">
                <h5 class="modal-title " id="exampleModalLongTitle">Welcome</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./logic/auth/signin.php?">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="username" required
                            aria-describedby="emailHelp" placeholder="Enter the username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required
                            placeholder="Password">
                    </div>
                    <div class="modal-footer d-flex flex-column">
                        <button type="submit" class="btn btn-orange" style="background-color:orange; border-radius: 10px;">LogIn</button>
                        <p class="text-secondary">You don't have an account?
                            <a href="./signup.php" data-reset="modal" data-target="#exampleModalCenter">Signup</a>
                        </p>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>