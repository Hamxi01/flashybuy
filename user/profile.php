<?php 
	include('include/header.php');
	$id = $_SESSION['user_id'];
	include('../includes/db.php');
$obj = new connection();
$query =$obj->user_profile($id);
$fetch = mysqli_fetch_array($query);	
?>
<style>
	* {
  box-sizing:border-box;
}
.clearfix:before,
.clearfix:after {
  content: "";
  display: table;
}
.clearfix:after {
  clear: both;
}
.vertical-tabs:before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: -1px;
  z-index: 1;
  border: 0px solid black;
}
.vertical-tabs:after {
  content: "";
  display: table;
  clear: both;
}
.vertical-tabs {
  position: relative;
  margin-left: 200px;
}
.tabs {
  position: relative;
  float: left;
  width: 200px;
  padding-left: 0;
  margin-top: 0px;
  margin-bottom: 0px;
  margin-left: -200px;
  font-family:"Work Sans", sans-serif;
}
.tabs li {
  position: relative;
  list-style: none;
  padding: 5px;
 font-family:"Work Sans", sans-serif;

}
.tabs li:after {
  content: "";
  display: table;
  clear: both;
    font-family:"Work Sans", sans-serif;
}
.tabs li a {
  position: relative;
  display: block;
  width: 100%;
  padding: 10px;
  text-decoration: none;
  text-align: center;
  border: 0px solid #ddd;
  border-right: 1px  solid black;
  background: #FCB800;
    font-family:"Work Sans", sans-serif;
}
.tabs li.active a {
  z-index: 2;
  border: 0px solid black;
  border-right: 0px solid white;
}
.tabs-content .content {
  display: none;
  padding: 10px;
}
.tabs-content .content.active {
  display: block;
}
</style>
    <h3 align="center">Manage Account</h3>
    <div class="ps-site-features">
        <h2> User Profile </h2>
<div class="vertical-tabs">
  <ul class="tabs vertical" data-tab="">
    <li class="tab-title active"><a href="#panela1" aria-selected="true" tabindex="0">Tab 1</a></li>
    <li class="tab-title"><a href="#panelb1" aria-selected="false" tabindex="-1">Tab 2</a></li>
    <li class="tab-title"><a href="#panelc1" aria-selected="false" tabindex="-1">Tab 3</a></li>
    <li class="tab-title"><a href="#paneld1" aria-selected="false" tabindex="-1">Tab 4</a></li>
    <li class="tab-title"><a href="#panele1" aria-selected="false" tabindex="-1">User</a></li>
  </ul>
  <div class="tabs-content">
    <div class="content active" id="panela1" aria-hidden="false" >
      <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Country</th>
                <th>City</th>
            </table>
        </div>
      </div>
    </div>
    <div class="content" id="panelb1" aria-hidden="true" tabindex="-1">
      <p>Tab2</p>
    </div>
    <div class="content" id="panelc1" aria-hidden="true" tabindex="-1">
      <p>sadsafsfssdf</p>
    </div>
    <div class="content" id="paneld1" aria-hidden="true" tabindex="-1">
      <p>Tab3</p>
    </div>
    <div class="content" id="panele1" aria-hidden="true" tabindex="-1">
      <p>Tab4</p>
    </div>
  </div>
</div>

         
        </div>

        <?php include('include/footer.php'); ?>
        <script>
            $().ready(function(){
  $('.tab-title>a').click(function(e){
    e.preventDefault();
    var index = $(this).parent().index();
    $(this).parent().addClass('active')
         .siblings().removeClass('active')
         .parent('ul.tabs').siblings('.tabs-content').children('.content').removeClass('active')
         .eq(index).addClass('active');
  });
})
        </script>