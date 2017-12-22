 <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

         <li class="<?php if($controller=='dashboard'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>dashboard">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>

          <li class="<?php if($controller=='user'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>user">
            <i class="fa fa-users"></i> <span>Pengguna</span>
          </a>
        </li>


           <li class="<?php if($controller=='products' || $controller=='categories'){ echo 'active';}?>">
           <a href="#" title="See Your Products">
           <i class="fa fa-shopping-cart"></i> <span>Products</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
           </a>
           
           <ul class="treeview-menu">


            <li class="<?php if($controller=='categories'){ echo 'active';}?>">
           <a href="<?php echo base_url();?>categories">
           <i class="fa fa-folder-open"></i> <span>Categories</span>
           </a>
           </li>
           
           <li class="<?php if($controller=='products'){ echo 'active';}?>">
           <a href="<?php echo base_url();?>products">
           <i class="fa fa-shopping-cart"></i> <span>Products</span>
           </a>
           </li>
           
          
           
           </ul>
           </li>


      
      








          <li class="<?php if($controller=='users'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>users">
            <i class="fa fa-history"></i> <span>Merchant</span>
          </a>
        </li>


        

         <li class="<?php if($controller=='zona'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>zona">
            <i class="fa fa-bar-chart"></i> <span>Transaction</span>
          </a>
        </li>





         <li class="<?php if($controller=='biaya' || $controller=='pakettiket'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>biaya">
            <i class="fa fa-ticket"></i> <span>Tarif</span>
          </a>
        </li>


         <li class="<?php if($controller=='administrator'){ echo 'active';}?>">
          <a href="<?php echo base_url();?>administrator">
            <i class="fa fa-users"></i> <span>Account</span>
          </a>
        </li>





      </ul>


