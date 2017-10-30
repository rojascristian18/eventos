<!-- START HEADER -->
  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
          <nav class="navbar-color">
              <div class="nav-wrapper">
                  <ul class="left">                      
                    <li><h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><?=$this->Html->image($todo['Evento']['logo']['path'], array('fullBase' => true));?></a> <span class="logo-text">Materialize</span></h1></li>
                  </ul>
                  <div class="header-search-wrapper hide-on-med-and-down">
                      <i class="mdi-action-search"></i>
                      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Busca tu herramienta o accesorios"/>
                  </div>
                  <ul class="right hide-on-med-and-down">
                      <li><b>Te ayudamos</b></li>
                      <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light phone-button"  data-activates="phone-dropdown"><i class="mdi-communication-phone"></i></a></li>
                      <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light email-button" data-activates="email-dropdown"><i class="mdi-communication-email"></i></a></li>
                  </ul>
                  <!-- Phones-button -->
                  <ul id="phone-dropdown" class="dropdown-content">
                    <li>
                      <a href="tel:<?=$todo['Evento']['fono'];?>">Venta telefónica: <b><?=$todo['Evento']['fono'];?></b></a>
                    </li>
                  </ul>
                  <!-- emails-dropdown -->
                  <ul id="email-dropdown" class="dropdown-content">
                    <li>
                      <a href="mailto:<?=$todo['Evento']['email'];?>">Escríbenos: <b><?=$todo['Evento']['email'];?></b></a>
                    </li>
                  </ul>
              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <!-- END HEADER -->