<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal" role="navigation">

        <ul class="nav">
            <?php

            $category = getData('categories');

            foreach ($category as $key => $value) {
                echo "
                    <li class='dropdown menu-item'>           
                     <a href='http://localhost/OnlineMarket/index.php?category=".$value->_id."' class='dropdown-toggle'><i class='icon fa fa-desktop fa-fw'></i> 
                        " . $value->name . "
                     </a>  
                     </li>             
                ";
            }
            ?>

        </ul>
    </nav>
</div>