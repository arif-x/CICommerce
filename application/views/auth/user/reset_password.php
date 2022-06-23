<!-- Main Container  -->

<div class="container">
   <div class="row">
      <ul class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i></a></li>
         <li><a href="#">Akun</a></li>
         <li><a href="#">Lupa Password</a></li>
      </ul>
      <div id="content" class="col-md-12 offset-md-3">
         <div class="well col-sm-12 offset-sm-3">    
            <h2>Lupa Password</h2>
            <form action="<?= base_url() ?>reset-password/store" method="post">
               <div class="form-group">
                  <label class="control-label" for="input-email">E-Mail</label>
                  <input type="text" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
                  <a href="<?= base_url() ?>login">Sudah Ingat? Login Disini</a>
               </div>
               <input type="submit" value="Reset" class="btn btn-primary pull-left">  
            </form>                          
         </div>
      </div>
   </div>

</div>
