<!DOCTYPE html>
<html>
    <!--
    An example file to demonstrate the PayFast Webcheckout integration
    -->
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>PayFast WebCheckout Integration Demo</title>
    </head>
    <body>
        <?php
        $merchantid = "SOME_MERCHANT_ID"; // Provided by Payfast
        $secret = "SOME_SECURED_KEY"; // Provided by PayFast

        $merchantid = "99999";
        $secret = "xxxxxxxxxxx";

        /**
         * fetch token based on Merchant ID and Secured Key
         */
        $token_url = "https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken?MERCHANT_ID=" . $merchantid . "&SECURED_KEY=" . $secret;
        $response = curl_request($token_url);

        $token_info = json_decode($response);

        $token = "";
        if (isset($token_info->ACCESS_TOKEN)) {
            $token = $token_info->ACCESS_TOKEN;
        }

        /**
         *  curl Request 
         */
        function curl_request($url) {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'application/json; charset=utf-8    '
            ));
            curl_setopt($ch, CURLOPT_USERAGENT, 'Your User Agent ver.0.0');
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }
        ?>
        <div class="container">
            <h2>PayFast WebCheckout Integration Demo</h2>
            
            <div class="card">

                <div class="card-body">
                    <div class="card-header">
                        PayFasy Web Checkout - Example Code
                    </div>
                    <!--
                        Submit form to PayFast WebCheckout
                    --->
                    <form method="post" action = "https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction"> 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Merchant ID</label>
                                    <INPUT class="form-control" TYPE="TEXT" NAME="MERCHANT_ID"  VALUE="<?php echo $merchantid; ?>"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Merchant Name</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="MERCHANT_NAME" value='My Merchant'> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group" >
                                    <label>Token</label>
									<!--
										Token value which was fetched earilier
									-->
                                    <INPUT  class="form-control"  TYPE="TEXT" NAME="TOKEN" VALUE="<?php echo $token; ?>"  data-toggle="tooltip" role="tooltip" title="Temporary Token"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Proccode</label>
                                    <INPUT readonly="readonly"  class="form-control" TYPE="TEXT" NAME="PROCCODE" VALUE="00"> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label>Amount</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="TXNAMT" VALUE = "10"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Mobile Number</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="CUSTOMER_MOBILE_NO" VALUE="+92300000000"> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer Email</label>
                                    <INPUT class="form-control"  TYPE="TEXT" NAME="CUSTOMER_EMAIL_ADDRESS" VALUE="email@example.com"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Signature</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="SIGNATURE" VALUE="RANDOMSTRINGVALUE"> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Version</label>
                                    <INPUT class="form-control" TYPE="TEXT" NAME="VERSION" VALUE="MY_VER_1.0"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Transaction Description</label>
                                    <INPUT class="form-control" TYPE="TEXT" NAME="TXNDESC" VALUE="HP Mouse X1"> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Success CallBack URL</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="SUCCESS_URL" VALUE="http://your-merchant-site.com/order/success"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Failure CallBack URL</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="FAILURE_URL" VALUE="http://your-merchant-site.com/order/failure"> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Basket ID/Order ID</label>
                                    <INPUT class="form-control"  TYPE="TEXT" NAME="BASKET_ID" VALUE="<?php echo uniqid('ORDER_'); ?>"> 
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Order Date</label>
                                    <INPUT  class="form-control" TYPE="TEXT" NAME="ORDER_DATE" VALUE="<?php echo date('Y-m-d', time()) ?>"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Checkout URL</label>
                            <INPUT  class="form-control" TYPE="TEXT" NAME="CHECKOUT_URL" VALUE="your-merchant-site.com/order/backend/confirm"> 
                        </div>
                        <div class="form-group">
                            <INPUT  class="btn btn-primary" TYPE="SUBMIT" value="PAY NOW"> 
                        </div>

                    </form> 
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </div>
    </body>
</html>
