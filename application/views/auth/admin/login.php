<!-- Main Container  -->

<div class="container">
   <div class="row">
      <ul class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i></a></li>
         <li><a href="#">Account</a></li>
         <li><a href="#">Login</a></li>
      </ul>
      <div id="content" class="col-md-12 offset-md-3">
         <div class="well col-sm-12 offset-sm-3">    
            <h2>Login</h2>
            <form action="<?= base_url() ?>admin/login" method="post">
               <div class="form-group">
                  <label class="control-label" for="input-email">E-Mail</label>
                  <input type="text" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
               </div>
               <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
                  <a href="#">Forgotten Password</a>
               </div>
               <input type="submit" value="Login" class="btn btn-primary pull-left">  
            </form>
            <column id="column-login" class="col-sm-8 pull-right">
               <div class="row">
                  <div class="social_login pull-right" id="so_sociallogin">
                     <a href="#" class="btn btn-social-icon btn-sm btn-facebook"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></a>
                     <a href="#" class="btn btn-social-icon btn-sm btn-twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></a>
                     <a href="#" class="btn btn-social-icon btn-sm btn-google-plus"><i class="fa fa-google fa-fw" aria-hidden="true"></i></a>
                     <a href="#" class="btn btn-social-icon btn-sm btn-linkdin"><i class="fa fa-linkedin fa-fw" aria-hidden="true"></i></a>
                  </div>
               </div>
            </column>                            
         </div>
      </div>
   </div>

</div>
