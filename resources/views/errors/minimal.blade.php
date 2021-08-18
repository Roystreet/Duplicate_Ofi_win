<!DOCTYPE html>
  <html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Víctor Enrique Pérez Guevara" />
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('sb-ui-kit-pro/dist/css/styles.css')  }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        @yield('componentcss')
        <!-- Styles -->
        <style>
        * {
margin:0px auto;
padding: 0px;
text-align:center;
}
body {
background-color: #ffffff;
}
.cont_principal {
position: absolute;
width: 100%;
height: 100%;
overflow: hidden;
}
.cont_error {
position: absolute;
width: 100%;
height: 300px;
top: 50%;
margin-top:-150px;
}

.cont_error > h1  {
font-family: 'Lato', sans-serif;
font-weight: 400;
font-size:150px;
color:#0a3f5d;
position: relative;
left:-100%;
transition: all 0.5s;
}


.cont_error > p  {
font-family: 'Lato', sans-serif;
font-weight: 300;
font-size:24px;
letter-spacing: 5px;
color:#9294AE;
position: relative;
left:100%;
transition: all 0.5s;
transition-delay: 0.5s;
-webkit-transition: all 0.5s;
-webkit-transition-delay: 0.5s;
}

.cont_aura_1 {
position:absolute;
width:300px;
height: 120%;
top:25px;
right: -340px;
background-color: #0a3f5d;
box-shadow: 0px 0px  60px  20px  rgba(10,63,93,0.5);
-webkit-transition: all 0.5s;
transition: all 0.5s;
}

.cont_aura_2 {
position:absolute;
width:100%;
height: 300px;
right:-10%;
bottom:-301px;
background-color: #0a3f5d;
box-shadow: 0px 0px 60px 10px rgba(10, 63, 93, 0.5),0px 0px  20px  0px  rgba(0,0,0,0.1);
z-index:5;
transition: all 0.5s;
-webkit-transition: all 0.5s;
}

.cont_error_active > .cont_error > h1 {
left:0%;
}
.cont_error_active > .cont_error > p {
left:0%;
}

.cont_error_active > .cont_aura_2 {
animation-name: animation_error_2;
animation-duration: 4s;
animation-timing-function: linear;
animation-iteration-count: infinite;
animation-direction: alternate;
transform: rotate(-20deg);
}
.cont_error_active > .cont_aura_1 {
transform: rotate(20deg);
right:-170px;
animation-name: animation_error_1;
animation-duration: 4s;
animation-timing-function: linear;
animation-iteration-count: infinite;
animation-direction: alternate;
}

@-webkit-keyframes animation_error_1 {
from {
-webkit-transform: rotate(20deg);
transform: rotate(20deg);
}
to {  -webkit-transform: rotate(25deg);
transform: rotate(25deg);
}
}
@-o-keyframes animation_error_1 {
from {
-webkit-transform: rotate(20deg);
transform: rotate(20deg);
}
to {  -webkit-transform: rotate(25deg);
transform: rotate(25deg);
}

}
@-moz-keyframes animation_error_1 {
from {
-webkit-transform: rotate(20deg);
transform: rotate(20deg);
}
to {  -webkit-transform: rotate(25deg);
transform: rotate(25deg);
}

}
@keyframes animation_error_1 {
from {
-webkit-transform: rotate(20deg);
transform: rotate(20deg);
}
to {  -webkit-transform: rotate(25deg);
transform: rotate(25deg);
}
}




@-webkit-keyframes animation_error_2 {
from { -webkit-transform: rotate(-15deg);
transform: rotate(-15deg);
}
to { -webkit-transform: rotate(-20deg);
transform: rotate(-20deg);
}
}
@-o-keyframes animation_error_2 {
from { -webkit-transform: rotate(-15deg);
transform: rotate(-15deg);
}
to { -webkit-transform: rotate(-20deg);
transform: rotate(-20deg);
}
}
}
@-moz-keyframes animation_error_2 {
from { -webkit-transform: rotate(-15deg);
transform: rotate(-15deg);
}
to { -webkit-transform: rotate(-20deg);
transform: rotate(-20deg);
}
}
@keyframes animation_error_2 {
from { -webkit-transform: rotate(-15deg);
transform: rotate(-15deg);
}
to { -webkit-transform: rotate(-20deg);
transform: rotate(-20deg);
}
}
.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.code {
    border-right: 2px solid;
    font-size: 26px;
    padding: 0 15px 0 15px;
    text-align: center;
}

.message {
    font-size: 18px;
    text-align: center;
}
@media screen and (max-width: 1920px){
  .cont_aura_1 {
  position:absolute;
  width:300px;
  height: 120%;
  top:25px;
  right: -340px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px  60px  20px  rgba(10,63,93,0.5);
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  }
  .cont_aura_2 {
  position:absolute;
  width:100%;
  height: 300px;
  right:-10%;
  bottom:-301px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px 60px 10px rgba(10, 63, 93, 0.5),0px 0px  20px  0px  rgba(0,0,0,0.1);
  z-index:5;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  }
}
@media screen and (max-width: 1280px){

}
@media screen and (max-width: 800px){
  .cont_aura_1 {
  position:absolute;
  width:250px;
  height: 120%;
  top:25px;
  right: -340px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px  60px  20px  rgba(10,63,93,0.5);
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  }
  .cont_aura_2 {
  position:absolute;
  width:150%;
  height: 300px;
  right:-10%;
  bottom:-301px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px 60px 10px rgba(10, 63, 93, 0.5),0px 0px  20px  0px  rgba(0,0,0,0.1);
  z-index:5;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  }
}
@media screen and (max-width: 400px){
  .cont_aura_1 {
  position:absolute;
  width:200px;
  height: 120%;
  top:25px;
  right: -340px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px  60px  20px  rgba(10,63,93,0.5);
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  }
  .cont_aura_2 {
  position:absolute;
  width:150%;
  height: 350px;
  right:-10%;
  bottom:-301px;
  background-color: #0a3f5d;
  box-shadow: 0px 0px 60px 10px rgba(10, 63, 93, 0.5),0px 0px  20px  0px  rgba(0,0,0,0.1);
  z-index:5;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  }
}

        </style>
    </head>
    <body class="body-1 ">
      <div class="cont_principal flex-center position-ref full-height absolute pin bg-cover bg-no-repeat">
<div class="cont_error">

<h1>@yield('code')</h1>
  <p> @yield('message')</p>
  <button type="button" onclick="goBack()" name="button" class="btn btn-success" > Regresar </button>

  </div>
<div class="cont_aura_1"></div>
<div class="cont_aura_2"></div>
</div>
    </body>
    <script type="text/javascript">
    window.onload = function(){
document.querySelector('.cont_principal').className= "cont_principal cont_error_active";
}
function goBack(){
  window.history.back();
}
    </script>
    </html>
