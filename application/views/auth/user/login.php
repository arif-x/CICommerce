<!-- Main Container  -->

<div class="container">
   <div class="row">
      <ul class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i></a></li>
         <li><a href="#">Akun</a></li>
         <li><a href="#">Login</a></li>
      </ul>
      <div id="content" class="col-md-12 offset-md-3">
         <div class="well col-sm-12 offset-sm-3">    
            <h2>Login</h2>
            <form action="<?= base_url() ?>login" method="post">
               <div class="form-group">
                  <label class="control-label" for="input-email">E-Mail</label>
                  <input type="text" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
               </div>
               <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
                  <a href="<?= base_url() ?>reset-password">Lupa Password?</a>
               </div>
               <input type="submit" value="Login" class="btn btn-primary pull-left">  
            </form>                          
         </div>
      </div>
   </div>

</div>
