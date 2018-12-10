<?php

public function menu_nores(){
    echo '<nav class="navbar navbar-expand-sm py-0">
            <div class="collapse navbar-collapse flex-row-reverse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Idioma      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">ES</a></li>
                    <li><a class="dropdown-item" href="#">CA</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="img/mapa_parc.jpg">Mapa</a>
                </li>
              <li>
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li>
                <button type="button" class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-star"></span>
                </button>
              </li>
              </ul>
            </div>
          </nav>

          <nav class="navbar navbar-expand-sm bg-dark navbar-dark py-4">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Parc      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="noticies/noticies_1.php">Noticies</a></li>
                    <li><a class="dropdown-item" href="promocions.php">Promocions</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Atraccions</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hotel      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Habitacions</a></li>
                    <li><a class="dropdown-item" href="#">Restaurants</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Entrades      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="Entrades/parc/entrades1.php">Parc</a></li>
                    <li><a class="dropdown-item" href="Entrades/hoteliparc/entrades2.php">Parc+Hotel</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </nav>';
}

public function menu_client(){
    echo '<nav class="navbar navbar-expand-sm py-0">
            <div class="collapse navbar-collapse flex-row-reverse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Idioma      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">ES</a></li>
                    <li><a class="dropdown-item" href="#">CA</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="img/mapa_parc.jpg">Mapa</a>
                </li>
              <li>
                <a class="nav-link" href="login.php">'.$_SESSION['username'].'</a>
              </li>
              <li>
                <button type="button" class="btn btn-default btn-sm">
                  <span class="glyphicon glyphicon-star"></span>
                </button>
              </li>
              </ul>
            </div>
          </nav>

          <nav class="navbar navbar-expand-sm bg-dark navbar-dark py-4">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Parc      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="noticies/noticies_1.php">Noticies</a></li>
                    <li><a class="dropdown-item" href="promocions.php">Promocions</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Atraccions</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hotel      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Habitacions</a></li>
                    <li><a class="dropdown-item" href="#">Restaurants</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Entrades      </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="Entrades/parc/entrades1.php">Parc</a></li>
                    <li><a class="dropdown-item" href="Entrades/hoteliparc/entrades2.php">Parc+Hotel</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </nav>';
}


public function menu_treballador(){
  
}



 ?>
