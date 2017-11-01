<!-- START HEADER -->
  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
          <nav class="navbar-color naranjo">
              <div class="nav-wrapper">
                  <ul class="left">                      
                    <li><h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><?=$this->Html->image($todo['Evento']['logo']['path'], array('fullBase' => true));?></a> <span class="logo-text">Materialize</span></h1></li>
                  </ul>
                  <div class="header-search-wrapper hide-on-med-and-down">
                      <i class="mdi-action-search"></i>
                      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Busca tu herramienta o accesorios"/>
                  </div>
                  <ul class="right carrito">
                      <li><?=$this->Html->link('<span class="action-text">Ir al carrito de compras</span> <i class="mdi-action-shopping-cart"></i>', sprintf('https://%s/%s' , $todo['Tienda']['url'], 'carrito'), array('class' => 'waves-effect waves-block waves-light cart-button', 'escape' => false))?></li>
                  </ul>
              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <!-- END HEADER -->