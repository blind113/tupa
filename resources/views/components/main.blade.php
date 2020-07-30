<main class="page-content content-wrap">
  <div class="navbar">
    <div class="navbar-inner">
      <div class="logo-box">
        <a href="<?= url("/inv") ?>" class="logo-text">
          <span>
            <img src="<?= asset("assets/images/logo_plansul.png") ?>" alt="29px" width="117px"/>
          </span>
        </a>
      </div>
      <div class="topmenu-outer">
        <div class="top-menu">
          
        </div>
        
      </div>  
       
    </div>
  </div>  
  <div class="page-inner">
    <div id="main-wrapper">
      <div class="container">
        <div class ='row'>
            <div class = 'col col-sm-11'>
            </div>
            <div class = 'col col-sm-1 '>
              <button type="button" data-toggle="modal" data-target="#infos" ><span class='fa fa-info'></span></a>
            </div>
          </div> 
        @yield('content')
      </div>
    </div>
    
  </div>
</main>


