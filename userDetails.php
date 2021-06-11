<?php 
    session_start();

    require 'config/config.php';
    include 'header.php';
    ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../library/css/bootstrap.min.css">
<style>
  h2, h3 {
    margin-top: 0px;
    padding-top: 0px;
  }
  td {
    border-top: none !important;
  }
</style>
</head>
<body>

    <div class="row">
      <div class="col-md-7 well">
        <h3>Billing Address</h3>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-user"></span>
            </div>
            <input class="form-control" type="text" id="billing_name" name="billing_name" placeholder="Full Name" value="<?= $customer['name']; ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-envelope"></span>
            </div>
            <input class="form-control" type="text" id="billing_email" name="billing_email" placeholder="example@gmail.com" value="<?= $customer['email']; ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-earphone"></span>
            </div>
            <input class="form-control" type="text" id="billing_tel" name="billing_tel" placeholder="+91 0000 00000 0" value="<?= $customer['mobile']; ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" id="billing_address" name="billing_address" placeholder="11, Abc road" value="<?= $customer['address']; ?>">
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" id="billing_city" name="billing_city" placeholder="Hydearabad" value="Hyderabad">
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon addon-diff-color">
                    <span class="glyphicon glyphicon-home"></span>
                </div>
                <input class="form-control" type="text" id="billing_state" name="billing_state" placeholder="xyz" value="xyz">
              </div>
            </div>
          </div>
          <div class="col-md-5 col-md-offset-2">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon addon-diff-color">
                    <span class="glyphicon glyphicon-map-marker"></span>
                </div>
                <input class="form-control" type="text" id="billing_zip" name="billing_zip" placeholder="400-000-3" value="400-000-3">
              </div>
            </div>
          </div> 
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" id="billing_country" name="billing_country" placeholder="India" value="India">
          </div>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1 well">
        <div class="text-right">
          <h3>Your Order</h3>
          <h4><span class="glyphicon glyphicon-shopping-cart"></span><sup id="itemCount"><?= $cartPrices['itemCount']; ?></sup></h4>
          <table class="table">
            <tbody>
              <?php 
                foreach ($cartItems as $key => $product) { 
               ?>    
                <tr>
                  <td align="right" width="85%">
                    <a href="#"><?= $product['id']; ?></a>
                  </td>
                  <td width="15%">
                    <strong><span>&#x20b9;</span><?= ($cartItem['mrp']*$cartItem['quantity']); ?></strong>
                  </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr style="border: 1px dotted gray;">
          <p>Total: <strong>
              <span>$</span><?= $mrp['ctotal']; ?>
            </strong>
          </p>
        </div>
        <div class="text-right">
        <form method="POST" action="payments.php">
          <input type="submit" value="Proceed to Mode Of Payment" class="btn btn-warning btn-block">
        </div>
      </div>
    </div>
  </form>
</div>
</body>
</html>

<?php include 'footer.php';?>
