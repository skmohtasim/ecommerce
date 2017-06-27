<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="signUpModalLabel">Crate your Dealon.live Account</h4>
                    </div>
                    <div class="modal-body">
        
        
                       <form class="login-form"  id="uloginform" >
                         <div class="form-group">
                           <label for="exampleInputEmail1">Email address</label>
                           <input type="email"  class="form-control" id="email1" placeholder="">
                         </div>
        
                         <div class="form-group">
                           <label for="Password">Password</label>
                           <input type="password" class="form-control" id="password1" placeholder="">
                         </div>
        
                         <button type="button" class="btn btn-success btn-lg" onclick="Login();">Log In</button>
                         <a href="javascript:Void(0);" class="btn" id="createAccount">Create new account</a>
                       </form>
        
        
        
                      <form class="signup-form hidden" action="userregistration.php" id="uregisterform">
                         <div class="form-group">
                           <label for="exampleInputEmail1">Email address</label>
                           <input type="email" class="form-control" id="email2" placeholder="">
                         </div>
        
                         <div class="form-group">
                           <label for="Name">Your Name</label>
                           <input type="text" class="form-control" id="name" placeholder="">
                         </div>
        				<div class="form-group">
                           <label for="Phone">Phone Number</label>
                           <input type="text" class="form-control" id="phone" placeholder="">
                         </div>
                         <div class="form-group">
                           <label for="Password">Password</label>
                           <input type="password" class="form-control" id="password2" placeholder="">
                         </div>
        
                         <div class="form-group">
                           <label for="rePassword">Retype Password</label>
                           <input type="repassword" class="form-control" id="rePassword" placeholder="">
                         </div>
        
                         
        
                         <div class="form-group">
                           <label for="Address">Address</label>
                           <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                         </div>
        
                         <button type="button" class="btn btn-success btn-lg" onclick="Register();">Sign Up</button>
                         <a href="javascript:void();" class="btn" id="logIn">Already have an Account? Login Now</a>
                       </form>
        
                       <div class="text-success text-center">
                          <i class="fa fa-check"></i>
                          Successfully loged in
                       </div>
        
                       <div class="text-danger text-center">
                          <i class="fa fa-warning"></i>
                          Wrong email address or password
                       </div>
                    </div>
                  </div>
                </div>
              </div>