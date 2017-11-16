<!-- START HEADER -->
  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
          <nav class="navbar-color">
              <div class="nav-wrapper">
                  <ul class="left">                      
                    <li><h1 class="logo-wrapper"><a href="<?=$this->Html->url('/', true);?>" class="brand-logo darken-1"><?=$this->Html->image($todo['Evento']['logo']['path'], array('fullBase' => true));?></a> <span class="logo-text">Materialize</span></h1></li>
                  </ul>
                  <div class="header-search-wrapper hide-on-med-and-down">
                      <?= $this->Form->create('Buscar', array('type' => 'get', 'url' => array('controller' => $this->request->params['controller'], 'action' => $this->request->params['action']), 'inputDefaults' => array('div' => false, 'label' => false), 'autocomplete' => false)); ?>
                          <i class="mdi-action-search"></i>
                          <input type="text" name="b" class="header-search-input z-depth-2 autocomplete" placeholder="Busca tu herramienta o accesorio" autocomplete="off">
                      <?= $this->Form->end(); ?>
                  </div>
                  <ul class="right">
                      <li><?=$this->Html->link('<i class="mdi-action-shopping-cart"></i>', sprintf('https://%s/%s' , $todo['Tienda']['url'], 'carrito'), array('class' => 'waves-effect waves-block waves-light cart-button', 'escape' => false, 'target' => '_blank'))?></li>
                      <li class="hide-on-med-and-down">
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light fono-button"  data-activates="fono-dropdown"><i class="large mdi-communication-phone"></i></a>
                      </li>
                      <li class="hide-on-med-and-down">
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light email-button"  data-activates="email-dropdown"><i class="large mdi-communication-email"></i></a>
                      </li>
                      <li class="hide-on-med-and-down">
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light whatsapp-button"  data-activates="whatsapp-dropdown"><i class="small no-block fa fa-whatsapp" aria-hidden="true"></i></a>
                      </li>
                  </ul>

                  <!-- fono-button -->
                  <ul id="fono-dropdown" class="dropdown-content">
                    <li>
                        <div class="col s12 no-padding valign-wrapper center-align">
                          <a href="tel:<?=$todo['Evento']['fono'];?>"><i class="large mdi-communication-phone"></i> <span class="texto">Venta telefónica: <?=$todo['Evento']['fono'];?></span></a>
                        </div>
                    </li>
                  </ul>

                  <!-- email-button -->
                  <ul id="email-dropdown" class="dropdown-content">
                    <li>
                      <div class="col s12 no-padding valign-wrapper center-align">
                        <a href="tel:<?=$todo['Evento']['email'];?>"> <i class="large mdi-communication-email"></i> <span class="texto">Escíbenos: <?=$todo['Evento']['email'];?></span></a>
                      </div>
                    </li>
                  </ul>

                  <!-- whatsapp-button -->
                  <ul id="whatsapp-dropdown" class="dropdown-content">
                    <li>
                      <div class="col s12 no-padding valign-wrapper center-align">
                        <a href="!#"><i class="small fa fa-whatsapp" aria-hidden="true"></i> <span class="texto">Chat: +56 9 4207 7596</span></a>
                      </div>
                    </li>
                  </ul>
              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <!-- END HEADER -->