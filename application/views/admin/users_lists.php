<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">Users Lists</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Users</a>
                </li>
                <li class="breadcrumb-item active">Users Lists
                </li>
              </ol>
            </div>
          </div>
        </div>
       
      </div>
      <div class="content-body">
        <!-- Zero configuration table -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Users Lists</h4>
                  
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard ">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Profile Picture</th>
                          <th>Department</th>
                          <th>About</th>
                          <th>hobbies</th>
                          <th>Insert Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 1; 
                      foreach ($collection as $record) { 
                        $id = $record['users_id']; ?>
                        <tr>
                        <td><?php echo $record['name'] ?></td> 
                        <td><?php echo $record['email'] ?></td>
                        <td><img src="<?php echo base_url($record['profile_picture_path'])?>" width="50%" /></td>
                        <td><?php echo $record['department_name'] ?></td>
                        <td><?php echo $record['about'] ?></td>
                        <td><?php echo $record['u_hobbie'] ?></td>
                        <td><?php echo $record['insert_dt'] ?></td>
                        <td><a href="<?php //echo base_url("admin/users_lists/send_req/$id") ?>" class="tooltips" title="Send Friend Request" > Send Friend Request</a></td>
                        </tr>
                        <?php $i++;  } ?>
                      </tfoot>
                    </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
       

      </div>
    </div>
  </div>