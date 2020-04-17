<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

    if (isset($_POST['type'])) {
   
        $subsubcategory_id = $_GET['id'];

        // Options data //

        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i=0; $i < count($_POST['type']); $i++) {
            $item['type'] = $_POST['type'][$i];
            $item['label'] = $_POST['label'][$i];
            if(in_array($_POST['type'][$i], $select_types)){
                $item['options'] = json_encode($_POST['options_'.$_POST['option'][$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $data = json_encode($form);

        // End options code //
    
    //Check selected Category have already options or not///

        $sql = "SELECT * from variant_options where subsubcategory_id = '$subsubcategory_id'";
        $query = mysqli_query($con,$sql);
        $rows = mysqli_num_rows($query);
        if ($rows>0) {
            
             // updating already have options //

             $stmt= $con->prepare("UPDATE variant_options SET options=? WHERE subsubcategory_id=?");
             $stmt->bind_param("ss",$data,$subsubcategory_id);
             if ($stmt->execute()) {
             
                 $msg = "<span>Options updated successfully...!!</span>";
             }
             else{


                $error = "<span>Something went wrong...!!</span>";
             }

        }else{

            /// insert new options for an category ////

            $stmt = $con->prepare("INSERT INTO variant_options (subsubcategory_id,options) VALUES (?, ?)");
            $stmt->bind_param("ss",$subsubcategory_id,$data);
            if ($stmt->execute()) {
             
                 $msg = "<span>Options Added successfully...!!</span>";
             }
             else{


                $error = "<span>Something went wrong...!!</span>";
             }

        }  
   }

?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<!-- Start Message -->
<?php
if (isset($error)) {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo $error; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($msg)) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo $msg; ?>

        </div>
    </div>
</div>
<?php 
}
?>
<!-- End Message  -->            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Dynamic Variant Options</h4>
<!--  Delete button for removing all options for selected category -->
                       
<!--  Delete button for removing all options for selected category -->
                  </div>
                  <div class="card-body p-0">
                      <form action="variant_options.php?id=<?php echo $_GET['id']; ?>" method="post">
                        <div class="row">  
                          <div class="col-lg-9 form-horizontal" id="form">
<!-- Fetching Dynamic options for selected category if they already added -->
<?php 
if (isset($_GET['id'])) {

    $subsubcategoryid = $_GET['id'];


    $sql = "SELECT * from variant_options WHERE subsubcategory_id ='$subsubcategoryid'";

    $query = mysqli_query($con,$sql);

    while ($row = mysqli_fetch_array($query)) {
        
        $options =  $row['options'];
        
    }
    if (!empty($options)) {
        
    
            foreach (json_decode($options) as $key => $element){
                if ($element->type == 'text' || $element->type == 'file'){ ?>
                        <div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                            <input type="hidden" name="type[]" value="<?=$element->type?>">
                            <div class="col-lg-3">
                                <label class="control-label"><?=ucfirst($element->type)?></label>
                            </div>
                            <div class="col-lg-7">
                                <input class="form-control" type="text" name="label[]" value="<?=$element->label?>" placeholder="Label">
                            </div>
                            <div class="col-lg-1"><span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span></div>
                        </div>
                <?php
                }
                elseif ($element->type == 'select' || $element->type == 'multi_select' || $element->type == 'radio'){?>
                    <div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                        <input type="hidden" name="type[]" value="<?=$element->type?>">
                        <input type="hidden" name="option[]" class="option" value="<?=$key?>">
                        <div class="col-lg-3">
                            <label class="control-label"><?=ucfirst(str_replace('_', ' ', $element->type))?></label>
                        </div>
                        <div class="col-lg-7">
                            <input class="form-control" type="text" name="label[]" value="<?=$element->label?>" placeholder="Select Label" style="margin-bottom:10px">
                            <div class="customer_choice_options_types_wrap_child">
                            <?php    
                                if (is_array(json_decode($element->options))){
                                    foreach (json_decode($element->options) as $value){
                            ?>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-sm-offset-4">
                                                <input class="form-control" type="text" name="options_<?=$key?>[]" value="<?=$value?>" required="">
                                            </div>
                                            <div class="col-sm-1"> <span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span></div>
                                        </div>
                            <?php            
                                    }
                                }
                            ?>    
                            </div>
                            <button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>
                        </div>
                        <div class="col-lg-2"><span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span></div>
                    </div>
                <?php    
                }
            }
    }        
}
?>
<!-- End Showing Dynamic options for selected category if they already added -->
                          </div>
<!--    Buttons for adding Dynamic options for Category  -->
                          <div class="col-lg-3">
                              <ul class="list-group">
                                  <li class="list-group-item btn-dark" style="text-align: left;" onclick="appenddToForm('text')">Text Input</li>
                                  <li class="list-group-item btn-dark" style="text-align: left;" onclick="appenddToForm('select')">Select</li>
                                  <li class="list-group-item btn-dark" style="text-align: left;" onclick="appenddToForm('multi-select')">Multiple Select</li>
                                  <li class="list-group-item btn-dark" style="text-align: left;" onclick="appenddToForm('radio')">Radio</li>
                                  <li class="list-group-item btn-dark" style="text-align: left;" onclick="appenddToForm('file')">File</li>
                              </ul>
                          </div>
<!--  End Buttons for adding Dynamic options for Category  -->                          
                        </div><br>
                        <div class="text-right">
                              <button class="btn btn-warning" type="submit">Save</button>
                        </div><br>  
                      </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('includes/footer.php') ?> 
      <!-- View Model -->
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>
<script type="text/javascript">

        var i = 0;

        function add_customer_choice_options(em){
            var j = $(em).closest('.form-group').find('.option').val();
            var str = '<div class="form-group">'
                            +'<div class="col-sm-6 col-sm-offset-4">'
                                +'<input class="form-control" type="text" name="options_'+j+'[]" value="" required>'
                            +'</div>'
                            +'<div class="col-sm-2"> <span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                            +'</div>'
                        +'</div>'
            $(em).parent().find('.customer_choice_options_types_wrap_child').append(str);
        }
        function delete_choice_clearfix(em){
            $(em).parent().parent().remove();
        }
        function appenddToForm(type){
            //$('#form').removeClass('seller_form_border');
            if(type == 'text'){
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                                +'<input type="hidden" name="type[]" value="text">'
                                +'<div class="col-lg-3">'
                                    +'<label class="control-label">Text</label>'
                                +'</div>'
                                +'<div class="col-lg-7">'
                                    +'<input class="form-control" type="text" name="label[]" placeholder="Label">'
                                +'</div>'
                                +'<div class="col-lg-2">'
                                    +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                                +'</div>'
                            +'</div>';
                $('#form').append(str);
            }
            else if (type == 'select') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                                +'<input type="hidden" name="type[]" value="select"><input type="hidden" name="option[]" class="option" value="'+i+'">'
                                +'<div class="col-lg-3">'
                                    +'<label class="control-label">Select</label>'
                                +'</div>'
                                +'<div class="col-lg-7">'
                                    +'<input class="form-control" type="text" name="label[]" placeholder="Select Label" style="margin-bottom:10px">'
                                    +'<div class="customer_choice_options_types_wrap_child">'

                                    +'</div>'
                                    +'<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                                +'</div>'
                                +'<div class="col-lg-2">'
                                    +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                                +'</div>'
                            +'</div>';
                $('#form').append(str);
            }
            else if (type == 'multi-select') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                                +'<input type="hidden" name="type[]" value="multi_select"><input type="hidden" name="option[]" class="option" value="'+i+'">'
                                +'<div class="col-lg-3">'
                                    +'<label class="control-label">Multiple select</label>'
                                +'</div>'
                                +'<div class="col-lg-7">'
                                    +'<input class="form-control" type="text" name="label[]" placeholder="Multiple Select Label" style="margin-bottom:10px">'
                                    +'<div class="customer_choice_options_types_wrap_child">'

                                    +'</div>'
                                    +'<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                                +'</div>'
                                +'<div class="col-lg-2">'
                                    +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                                +'</div>'
                            +'</div>';
                $('#form').append(str);
            }
            else if (type == 'radio') {
                i++;
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                                +'<input type="hidden" name="type[]" value="radio"><input type="hidden" name="option[]" class="option" value="'+i+'">'
                                +'<div class="col-lg-3">'
                                    +'<label class="control-label">Radio</label>'
                                +'</div>'
                                +'<div class="col-lg-7">'
                                    +'<input class="form-control" type="text" name="label[]" placeholder="Radio Label" style="margin-bottom:10px">'
                                    +'<div class="customer_choice_options_types_wrap_child">'

                                    +'</div>'
                                    +'<button class="btn btn-success pull-right" type="button" onclick="add_customer_choice_options(this)"><i class="glyphicon glyphicon-plus"></i> Add option</button>'
                                +'</div>'
                                +'<div class="col-lg-2">'
                                    +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                                +'</div>'
                            +'</div>';
                $('#form').append(str);
            }
            else if (type == 'file') {
                var str = '<div class="form-group" style="background:rgba(0,0,0,0.1);padding:10px 0;">'
                                +'<input type="hidden" name="type[]" value="file">'
                                +'<div class="col-lg-3">'
                                    +'<label class="control-label">File</label>'
                                +'</div>'
                                +'<div class="col-lg-7">'
                                    +'<input class="form-control" type="text" name="label[]" placeholder="Label">'
                                +'</div>'
                                +'<div class="col-lg-2">'
                                    +'<span class="btn btn-icon btn-circle icon-lg fa fa-times" onclick="delete_choice_clearfix(this)"></span>'
                                +'</div>'
                            +'</div>';
                $('#form').append(str);
            }
        }
</script>    