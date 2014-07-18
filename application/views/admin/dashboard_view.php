<?php if($this->admin_session->userdata['admin']['access'] == 'super_admin'):?>
  <div class="row-fluid">
  <div class="alert alert-block alert-success">
    <i class="icon-ok green"></i> Welcome to <strong class="green">Protisystem Application Dashboard</strong>
  </div>
    <div class="span7 infobox-container">
      <div class="infobox infobox-pink">
        <div class="infobox-icon"><i class="icon-shopping-cart"></i></div>
        <div class="infobox-data">
          <span class="infobox-data-number"><?=@$total_orders?></span>
          <span class="infobox-content">Total Sales</span>
        </div>
        <!-- <div class="stat stat-important">4%</div> -->
      </div>
      <div class="infobox infobox-green">
      <div class="infobox-icon"><i class="icon-group"></i></div>
        <div class="infobox-data">
          <span class="infobox-data-number"><?=@$total_partners?></span>
          <span class="infobox-content">Total Partners</span>
        </div>
        <!-- <div class="stat stat-success">8%</div> -->
      </div>
      <div class="infobox infobox-blue">
        <div class="infobox-icon"><i class="icon-briefcase"></i></div>
        <div class="infobox-data">
          <span class="infobox-data-number"><?=@$total_sales_rep?></span>
          <span class="infobox-content">Total Sales Reps</span>
        </div>
        <!-- <div class="badge badge-success">+32%</div> -->
      </div>
      <div class="infobox infobox-red">
        <div class="infobox-icon"><i class="icon-beaker"></i></div>
        <div class="infobox-data">
          <span class="infobox-data-number"><?=@$total_clients?></span>
          <span class="infobox-content">Total Clients</span>
        </div>
      </div>
      <div class="infobox infobox-orange2">
        <div class="infobox-chart">
          <span data-values="196,128,202,177,154,94,100,170,224" class="sparkline"><canvas style="display: inline-block; width: 44px; height: 33px; vertical-align: top;" width="44" height="33"></canvas></span>
        </div>
        <div class="infobox-data">
          <span class="infobox-data-number">$<?=@$total_sales?></span>
          <span class="infobox-content">Total Earnings</span>
        </div>
        <!-- <div class="badge badge-success">7.2% <i class="icon-arrow-up"></i></div> -->
      </div>
      <div class="infobox infobox-blue2">
        <div class="infobox-progress">
          <div data-size="46" data-percent="42" class="easy-pie-chart percentage easyPieChart" style="width: 46px; height: 46px; line-height: 46px;">
            <span class="percent">42</span>%
            <canvas height="46" width="46"></canvas>
          </div>
        </div>

        <div class="infobox-data">
          <span class="infobox-text">traffic used</span>
          <span class="infobox-content"><span class="approx">~</span> 58GB remaining</span>
        </div>
      </div>

      <div class="space-6"></div>
      <div class="infobox infobox-small infobox-dark infobox-blue">
        <div class="infobox-chart">
          <span data-values="3,4,2,3,4,4,2,2" class="sparkline"><canvas style="display: inline-block; width: 39px; height: 20px; vertical-align: top;" width="39" height="20"></canvas></span>
        </div>
        <div class="infobox-data">
          <span class="infobox-content">Commission</span>
          <br>
          <span class="infobox-content">$<?=@$total_commission?></span>
        </div>
      </div>
      <div class="infobox infobox-small infobox-dark infobox-green">
        <div class="infobox-progress">
          <div data-size="39" data-percent="<?=$commission_paid_percent?>" class="easy-pie-chart percentage easyPieChart" style="width: 39px; height: 39px; line-height: 39px;">
            <span class="percent"><?=$commission_paid_percent?></span>%
            <canvas height="39" width="39"></canvas>
          </div>
        </div>
        <div class="infobox-data">
          <span class="infobox-content"><b>Paid</b></span>
          <br>
          <span class="infobox-content">$<?=$paid_commission?></span>
        </div>
      </div>

      <div class="infobox infobox-small infobox-dark infobox-red">
        <div class="infobox-progress">
          <div data-size="39" data-percent="<?=$commission_pending_percent?>" class="easy-pie-chart percentage easyPieChart" style="width: 39px; height: 39px; line-height: 39px;">
            <span class="percent"><?=$commission_pending_percent?></span>%
            <canvas height="39" width="39"></canvas>
          </div>
        </div>
        <div class="infobox-data">
          <span class="infobox-content"><b>Pending</b></span>
          <br>
          <span class="infobox-content">$<?=$pending_commission?></span>
        </div>
      </div>

    </div>
  </div>
  <div class="hr hr32 hr-dotted"></div>
  <div class="row-fluid">
  <div class="widget-box transparent">
    <div class="widget-header">
      <h4 class="lighter smaller"><i class="icon-rss orange"></i>RECENT SALES</h4>
    </div>
    <div class="widget-body">
      <table class="table table-striped table-bordered" id="dt_d">
        <thead>
          <tr>
            <th>No.</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>User Name</th>
            <th>User Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $num = 0; if(isset($orders_records)) :foreach($orders_records as $row): $num++;
          ?>
          <tr>
            <td><?=$num?></td>
            <td><?php echo $row->first_name; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->phone; ?></td>
            <td><?php echo $row->address; ?></td>
            <td><?php echo $row->username; ?></td>
            <td><?php echo $row->access; ?></td>
            <td><?php echo $row->status; ?></td>
            <td>
              <a href="<?php echo site_url('admin/orders/show_order/'.$row->order_id.'/'.encode_id($row->order_id)); ?>" class="btn btn-primary btn-minier" title="View">View</a>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php else : ?>
        <?php endif; ?>
        </tbody>
      </table>
    </div>  
  </div>  
</div>
<?php endif;?>
