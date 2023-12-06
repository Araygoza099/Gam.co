<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gam.co | Método de pago</title>
    <link rel="stylesheet" href="./css/style_pagos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style_forms.css">
</head>

<body>

    <div class="container" style="background-color: white; border-radius: 5px; padding: 2px">
        <form id="paymentForm" action="compra.php" method="POST">
            <h3>Método de pago</h3>

            <div class="row">
                <div class="col-lg-6 mb-lg-3">
                    <div class="card p-1">
                        <div class="img-box">
                            <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">**** **** **** 1060</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                            <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-lg-3">
                    <div class="card p-1">
                        <div class="img-box">
                            <img src="https://www.freepnglogos.com/uploads/mastercard-png/file-mastercard-logo-svg-wikimedia-commons-4.png" alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">**** **** **** 1060</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
                            <small><span class="fw-bold">Name:</span><span>Kumar</span></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form__div">
                        <input name="card_number" type="text" class="form-control" placeholder="Card Number" maxlength="16" required>
                        <label class="form__label">Card Number</label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form__div">
                        <input type="text" name="card_date" class="form-control" placeholder="MM / YY" maxlength="5" required>
                        <label class="form__label">Expiry Date</label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form__div">
                        <input type="text" name="card_cvv" class="form-control" placeholder="CVV Code" maxlength="3" required>
                        <label class="form__label">CVV Code</label>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form__div">
                        <input type="text" class="form-control" name="card_name" placeholder="Name on the card" required>
                        <label class="form__label">Name on the card</label>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    <input value="Comprar" type="submit" class="btn btn-primary" id="contactus-submit">
                </div>
            </div>
        </form>
    </div>

</body>

</html>
