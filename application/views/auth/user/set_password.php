<!-- Main Container  -->

<div class="container">
   <div class="row">
      <ul class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i></a></li>
         <li><a href="#">Akun</a></li>
         <li><a href="#">Reset Password</a></li>
      </ul>
      <div id="content" class="col-md-12 offset-md-3">
         <div class="well col-sm-12 offset-sm-3">    
            <h2>Reset Password</h2>
            <form action="<?= base_url() ?>reset-password/set-password" method="post">
               <?php foreach ($key as $key => $value) { ?>
               <input type="hidden" name="password_key" value="<?= $value['password_key'] ?>">
               <div class="form-group">
                  <label class="control-label" for="input-password">Password</label>
                  <input type="password" name="password" value="" id="input-password" class="form-control">
                  <a href="<?= base_url() ?>login">Sudah Ingat? Login Disini</a>
               </div>
               <input type="submit" value="Reset Sekarang" class="btn btn-primary pull-left">  
               <?php } ?>
            </form>                          
         </div>
      </div>
   </div>

</div>
