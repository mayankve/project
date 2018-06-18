

<style>
body {
  padding : 10px ;
  
}

#exTab1 .tab-content {
  color : #000000;
  background-color: #eee;
  padding : 5px 15px;
}

#exTab2 h3 {
  color : white;
  background-color: #e09600;
  padding : 5px 15px;
}

/* remove border radius for the tab */

.nav-pills>li.active>a{
    
  background-color: #ffffff;
  color:#2e2e2e;
}
.nav-pills>li.active>a : hover{
    
  background-color: #eee;
  color:#2e2e2e;
}
/* change border radius for the tab , apply corners on top*/

#exTab3 .nav-pills > li > a {
  border-radius: 4px 4px 0 0 ;
 
}

#exTab3 .tab-content {
  color : white;
  background-color: #e09600;
  padding : 5px 15px;
}


</style>


<div id="exTab1" class="container">	
    <ul  class="nav nav-pills">
        <li class="active">
            <a  href="#1a" data-toggle="tab">Design Your Trip</a>
        </li>
        <li><a href="#2a" data-toggle="tab">Todo/Packing List</a>
        </li>
        <li><a href="#3a" data-toggle="tab">Travelers</a>
        </li>
        <li><a href="#4a" data-toggle="tab">Roommates/Referrals</a>
        </li>
    </ul>

    <div class="tab-content clearfix">
        <div class="tab-pane active" id="1a">
           Contents to be updated
        </div>
        <div class="tab-pane" id="2a">
            test2
        </div>
        <div class="tab-pane" id="3a">
          test 3
        </div>
        <div class="tab-pane" id="4a">
           test 4
        </div>
    </div>
</div>


<hr></hr>



<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>