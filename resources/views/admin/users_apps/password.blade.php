<!-- Card  -->
<div class="card mt-3">
 <!-- Card Title Perfil -->
 <div class="card-header border-bottom">Login</div>
 <!-- Card Body Perfil -->
 <div class="card-body">
     <div class="box box-success">
           <div class="row tema-back">

               <div class="row w-100 p-2">
                 <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                   <input type="text" class="form-control" placeholder="Contraseña" id="password" >
                 </div>
                 {{-- <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                   <input type="text" class="form-control" placeholder="Repetir contraseña" id="password_repedida">
                 </div> --}}

                 <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                   <button class="btn btn-primary" onclick="restaurar()">Cambiar contraseña</button>
                 </div>
               </div>

               <div class="row w-100 p-2">
                 <div class="col-sm-4 col-md-4 col-lg-3 col-xl-4">
                   <button class="btn btn-primary" onclick="restaurar_x_correo()">Restaurar contraseña por correo</button>
                 </div>

               </div>
           </div>
     </div>
 </div><!-- END Card Body  -->
</div><!-- END Card  -->
