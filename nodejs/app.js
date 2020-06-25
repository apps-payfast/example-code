var http = require('http');
const axios = require('axios');

http.createServer(async function (req, res) {

    const merchant_id = 999; //  provided by PayFast
    const secured_key = 'xxxxxxxxxx'; // provided by PayFast
    const tokenUrl = `https://ipguat.apps.net.pk/Ecommerce/api/Transaction/GetAccessToken?MERCHANT_ID=${merchant_id}&SECURED_KEY=${secured_key}`;

    const tokenResponse = await axios.get(tokenUrl);
    const token = tokenResponse.data.ACCESS_TOKEN !== undefined ? tokenResponse.data.ACCESS_TOKEN : null;
    if (!token) {
        res.end(`Invalid Merchant ID / Secured Key`);
        return;
    }

    const basket_id = Math.floor(Math.random() * Math.floor(100));
    
    var html = getHtml(token, merchant_id, `CART-NO-${basket_id}`, '2020-05-25');
    res.writeHead(200, { 'Content-Type': 'text/html' });
    res.end(html);
}).listen(8080);


function getHtml(token, merchant_id, basket_id, todays_date) {

    return `<!DOCTYPE html>
    <html>
        <!--
        An example file to demonstrate the PayFast Webcheckout integration
        -->
        <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <title>PayFast WebCheckout Integration Demo</title>
        </head>
        <body>
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
                                        <INPUT class="form-control" TYPE="TEXT" NAME="MERCHANT_ID"  VALUE="${merchant_id}"> 
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
                                        <INPUT  class="form-control"  TYPE="TEXT" NAME="TOKEN" VALUE="${token}"  data-toggle="tooltip" role="tooltip" title="Temporary Token"> 
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
                                        <INPUT class="form-control"  TYPE="TEXT" NAME="BASKET_ID" VALUE="${basket_id}"> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Order Date</label>
                                        <INPUT  class="form-control" TYPE="TEXT" NAME="ORDER_DATE" VALUE="${todays_date}"> 
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
    `;
}