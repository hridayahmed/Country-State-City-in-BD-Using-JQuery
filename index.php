<?php
session_start();
$con = mysqli_connect("localhost","root","","test2");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- page content -->
            <div class="right_col" role="main" style="margin-bottom: 10px;">

                <!-- main content again -->
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Bangladesh Zila Upazila </h2>
                      </div>
                      <div class="x_content">
                        <form id="define-standard-form" data-parsley-validate class="form-horizontal form-label-left">
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Division <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select id="division_id" name="division_id" class="action select2 pp_number form-control col-md-12 col-xs-12" onchange="">
                                <option value="" selected="selected">Select Division</option>
                                <?php
                                  $pp_sql = "SELECT DISTINCT id, name FROM bd_division ORDER BY id";
                                  $pp_res = mysqli_query($con, $pp_sql) or die(mysqli_error($con));
                                  while ($pp_row = mysqli_fetch_assoc($pp_res))
                                  {
                                      echo "<option value='".$pp_row['id']."'>";
                                      echo $pp_row['name'];
                                      echo "</option>";
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Zila <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select id="zila_id" name="zila_id" class="action zila_id form-control col-md-12 col-xs-12">
                                <option value="" selected="selected">Select Zila</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Upazila <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select id="upazila_id" name="upazila_id" class="action upazila_id form-control col-md-12 col-xs-12">
                                <option value="" selected="selected">Select Upazila</option>
                              </select>
                            </div>
                          </div>


                          <!-- <div class="ln_solid"></div> -->
                          <div class="form-group" style="padding-left: 7px; margin-top: 30px;">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2">
                              <button type="button" id="retrieve_data" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- main content finished -->

                <!-- main content again -->
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12" id="retrieve_general_data"></div>
                </div>
                <!-- main content again finished -->

            </div>
            <!-- /page content -->

        </div>
    </div>

    <script type="text/javascript">

      $(document).ready(function()
      {

          $('.action').change(function()
          {
              if($(this).val() != '')
              {
                  var action = $(this).attr("id");
                  var query = $(this).val();
                  var result = '';

                  if(action == "division_id")
                  {
                      result = 'zila_id';
                  }
                  else if (action == "zila_id")
                  {
                     result = 'upazila_id';
                  }
                  else
                  {

                  }
                  $.ajax(
                  {
                      url:"sql.php",
                      method:"POST",
                      data:{action:action, query:query},
                      success:function(data)
                      {

                          $('#'+result).html(data);
                      }
                  });
              }
          });

          $('#retrieve_data').click(function()
          {
              var division_id = document.getElementById("division_id").value;
              var zila_id = document.getElementById("zila_id").value;
              var upazila_id = document.getElementById("upazila_id").value;


              var formdata = new FormData(document.getElementById('define-standard-form'));
              formdata.append('division_id', division_id);
              formdata.append('zila_id', zila_id);
              formdata.append('upazila_id', upazila_id);

              $.ajax(
              {
                type: "POST",
                url: "saving.php",
                data: formdata,
                processData: false,
                contentType: false,
                error: function(jqXHR, textStatus, errorMessage)
                {
                    alert(errorMessage);
                },
                success: function(data)
                {
                    $("#retrieve_general_data").html(data);
                }
              });

          });
      });

  </script>
</body>
</html>
