<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
  <nav class="navbar navbar-expand-sm navbar-default">
      <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="active">
                  <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
              </li>
              <li class="menu-title">UI elements</li><!-- /.menu-title -->
              
              <li class="menu-item-has-children dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                  <ul class="sub-menu children dropdown-menu">
                      <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>
                      <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>
                  </ul>
              </li>
              <li class="menu-item-has-children dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                  <ul class="sub-menu children dropdown-menu">
                      <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                      <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                  </ul>
              </li>
              <li>
                  <a href="{{ route('exam.index')}}"> <i class="menu-icon ti-email"></i>Exam </a>
              </li>
          </ul>
      </div><!-- /.navbar-collapse -->
  </nav>
</aside>
<!-- /#left-panel -->