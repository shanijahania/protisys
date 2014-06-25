<div class="row-fluid">
<div class="span6">
  <div class="widget-box">
    <div class="widget-header">
      <h4>Overview & Stats  (Current Month)</h4>
    </div>
    <div class="widget-body">
      <div class="widget-body-inner">
        <div class="widget-main">
          <div class="row-fluid">
            <div class="span8">
              Total Sales
            </div>
            <div class="span2 pull-right">
              $ <?=@$total_sales?>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span8">
              Total Orders
            </div>
            <div class="span2 pull-right">
               <?=@$total_orders?>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span8">
              Total Partners
            </div>
            <div class="span2 pull-right">
               <?=@$total_partners?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row-fluid">
  <table class="table table-striped table-bordered" id="dt_d">
      <thead>
        <tr>
          <th>No.</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
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