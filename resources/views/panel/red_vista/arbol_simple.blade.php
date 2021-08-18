<style>

	.node {
		cursor: pointer;
	}

	.node circle {
	  fill: #fff;
	  stroke: #ccc;
	  stroke-width: 3px;
	}

	.node text {
	  font: 12px sans-serif;
	}

	.link {
	  fill: none;
	  stroke: #ccc;
	  stroke-width: 2px;
	}

    </style>
         <link rel="stylesheet" href="{{asset('/css/theme_admin.css')}}"/>
         <link rel="stylesheet" href="{{asset('/css/style_ov_admin.css')}}">

<section class="content-header">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</section>
  <div class="content">
    <div id="tree-container"></div>
  </div>

  <div id="loader-container" class="loader-container" style=" display:none; color: black; z-index: 10; position: fixed; padding-top: 20%;padding-left: 40%;padding-top: 20%;padding-right: 50%; padding-bottom: 50%; left: 0; top: 0; width: 100%; height: 100%;  background-color: rgb(0,0,0); background-color: rgba(255,255,255,0.4);">
    <div class="loader-container">
    <div class="loader"></div>
    <div style=" padding-top: 20%;padding-left: 33%;padding-top: 43%;padding-right: 50%; padding-bottom: 50%;"><b>Procesando</b></div>
    <div class="loader2"></div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://d3js.org/d3.v4.js" ></script>
<script src="{{ asset('js/red_vista/arbol_simple_classica.js') }}"></script>


