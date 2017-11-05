<!-- START HEADER -->
  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
          <nav class="navbar-color naranjo">
              <div class="nav-wrapper">
                  <ul class="left">                      
                    <li><h1 class="logo-wrapper"><a href="<?=$this->Html->url('/', true);?>" class="brand-logo darken-1"><?=$this->Html->image($todo['Evento']['logo']['path'], array('fullBase' => true));?></a> <span class="logo-text">Materialize</span></h1></li>
                  </ul>
                  <div class="header-search-wrapper hide-on-med-and-down">
                      <?= $this->Form->create('Buscar', array('type' => 'get', 'url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action']), 'inputDefaults' => array('div' => false, 'label' => false))); ?>
                          <i class="mdi-action-search active"></i>
                          <input type="text" name="b" class="header-search-input z-depth-2 autocomplete" placeholder="Busca tu herramienta o accesorio">
                      <?= $this->Form->end(); ?>
                  </div>
                  <ul class="right carrito">
                      <li><?=$this->Html->link('<span class="action-text hide-on-small-only">Ir al carrito de compras</span> <i class="mdi-action-shopping-cart"></i>', sprintf('https://%s/%s' , $todo['Tienda']['url'], 'carrito'), array('class' => 'waves-effect waves-block waves-light cart-button', 'escape' => false))?></li>
                  </ul>
              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <!-- END HEADER -->