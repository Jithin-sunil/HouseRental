<?php
include("../Assets/Connection/Connection.php");
session_start();

$row = null;
$amt = 0;

if (isset($_GET['bid']) && $_GET['bid'] != 0) {
    $bid = $_GET['bid'];
    $SelQry = "SELECT * FROM tbl_booking WHERE booking_id = $bid";
    $res = $Con->query($SelQry);
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $amt = $row['booking_amount'] * 0.05;
    }
} elseif (isset($_GET['rid']) && $_GET['rid'] != 0) {
    $rid = $_GET['rid'];
    $SelQry = "SELECT * FROM tbl_rent WHERE rent_id = $rid";
    $res = $Con->query($SelQry);
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $amt = $row['rent_tokenamount'];
    }
}

if (isset($_POST["btn_pay"])) {
    if (isset($_GET['bid']) && $_GET['bid'] != "") {
        $update = "UPDATE tbl_booking SET booking_status='3' WHERE booking_id = " . $_GET["bid"];
    } elseif (isset($_GET['rid']) && $_GET['rid'] != "") {
        $update = "UPDATE tbl_rent SET rent_status='3' WHERE rent_id = " . $_GET["rid"];
    }

    if (isset($update)) {
        if ($Con->query($update)) {
            echo '<script>showSuccessAnimation(); setTimeout(() => { window.location="Loader.php?amt=<?php echo $amt?>"; }, 2000);</script>';
        } else {
            echo "<script>alert('Payment update failed.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment Gateway | Online </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .payment-container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }
        
        .payment-illustration {
            flex: 1;
            background: linear-gradient(to bottom right, var(--primary), var(--secondary));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .payment-illustration::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }
        
        .payment-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .payment-header h2 {
            font-size: 28px;
            color: var(--dark);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .payment-header p {
            color: #666;
            font-size: 14px;
        }
        
        .payment-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--dark);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }
        
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
            outline: none;
            background-color: white;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .payment-amount {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f5f7ff;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .payment-amount span {
            font-size: 14px;
            color: #666;
        }
        
        .payment-amount .amount {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary);
        }
        
        .btn-pay {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .btn-pay::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-pay:hover::before {
            left: 100%;
        }
        
        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .payment-method {
            font-size: 36px;
            color: #555;
            transition: all 0.3s ease;
        }
        
        .payment-method:hover {
            transform: scale(1.1);
            color: var(--primary);
        }
        
        .fa-cc-visa { color: #1a1f71; }
        .fa-cc-mastercard { color: #eb001b; }
        .fa-cc-paypal { color: #003087; }
        .fa-cc-amex { color: #002663; }
        
        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        
        .secure-badge i {
            color: var(--success);
            font-size: 16px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shine {
            0% { transform: rotate(30deg) translate(-10%, -10%); }
            100% { transform: rotate(30deg) translate(10%, 10%); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .floating {
            animation: float 4s ease-in-out infinite;
        }
        
        @media (max-width: 768px) {
            .payment-container {
                flex-direction: column;
            }
            
            .payment-illustration {
                padding: 30px 20px;
            }
            
            .payment-form {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div class="payment-container">
            <div class="payment-illustration">
                <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_6wutsrox.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay class="floating"></lottie-player>
                <h2 style="color: white; margin-top: 20px;">Secure Payment Gateway</h2>
                <p style="color: rgba(255,255,255,0.8); text-align: center; max-width: 350px; margin-top: 10px;">Your payment information is encrypted and secure. We don't store any of your card details.</p>
                
                <div style="margin-top: 30px; display: flex; flex-direction: column; gap: 15px; width: 100%; max-width: 350px;">
                    <div style="display: flex; align-items: center; background: rgba(255,255,255,0.1); padding: 10px 15px; border-radius: 8px;">
                        <i class="fas fa-lock" style="font-size: 20px; margin-right: 10px;"></i>
                        <span style="font-size: 13px;">256-bit SSL Encryption</span>
                    </div>
                    <div style="display: flex; align-items: center; background: rgba(255,255,255,0.1); padding: 10px 15px; border-radius: 8px;">
                        <i class="fas fa-shield-alt" style="font-size: 20px; margin-right: 10px;"></i>
                        <span style="font-size: 13px;">PCI DSS Compliant</span>
                    </div>
                </div>
            </div>
            
            <div class="payment-form">
                <div class="payment-header">
                    <h2>Payment Details</h2>
                    <p>Complete your lab service payment securely</p>
                </div>
                
                <div class="payment-card">
                    <div class="form-group">
                        <label for="credit-card">Card Number</label>
                        <div style="position: relative;">
                            <input type="text" id="credit-card" required autocomplete="off" placeholder="1234 5678 9012 3456" title="Enter Correct Card Number" maxlength="19" name="txtacno" class="form-control">
                            <i class="far fa-credit-card" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #aaa;"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="txtname">Cardholder Name</label>
                        <input type="text" name="txtname" required autocomplete="off" pattern="[a-zA-z ]{3,15}" title="Enter Correct Name" minlength="3" placeholder="John Doe" class="form-control">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="txtexpdate">Expiration Date</label>
                            <input id="credit-card-exp" type="text" name="txtexpdate" required autocomplete="off" placeholder="MM/YY" pattern="[0-9/]{5,5}" title="Enter Correct Date" minlength="5" maxlength="5" class="form-control">
                            <span id="datecheck"></span>
                        </div>
                        <div class="form-group">
                            <label for="txtccv">CVV</label>
                            <div style="position: relative;">
                                <input type="text" id="credit-card-ccv" name="txtccv" required autocomplete="off" placeholder="123" pattern="[0-9]{3,3}" title="Enter Correct CVV" minlength="3" maxlength="3" class="form-control">
                                <i class="fas fa-question-circle" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #aaa; cursor: pointer;" title="3-digit code on back of your card"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="payment-amount">
                        <span>Total Amount</span>
                        <div class="amount">
                            <?php echo $amt?>
                            </div>
                    </div>
                    
                    <button type="submit" class="btn-pay" name="btn_pay">
                        <i class="fas fa-lock" style="margin-right: 8px;"></i> Pay Securely
                    </button>
                </div>
                
                <div class="payment-methods">
                    <i class="fab fa-cc-visa payment-method"></i>
                    <i class="fab fa-cc-mastercard payment-method"></i>
                    <i class="fab fa-cc-paypal payment-method"></i>
                    <i class="fab fa-cc-amex payment-method"></i>
                </div>
                
                <div class="secure-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Your payment is secured with 256-bit encryption</span>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
<!-- ... Your existing JavaScript code ... -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const creditCardInput = document.getElementById("credit-card");
        const creditCardExp = document.getElementById("credit-card-exp");
        const creditCardCcv = document.getElementById("credit-card-ccv");

        creditCardInput.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatCreditCard(inputValue);
            this.value = formattedValue;
        });

        creditCardExp.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatExpirationDate(inputValue);
            this.value = formattedValue;
        });

        // Function to validate expiration date
        function validateExpirationDate(inputValue) {
            const month = inputValue.slice(0, 2); // Extract month (assuming format MMYY)
            const year = inputValue.slice(2, 4); // Extract year (assuming format MMYY)

            // Get current date
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear() % 100; // Get last two digits of current year
            const currentMonth = currentDate.getMonth() + 1; // getMonth() returns 0-11, so add 1

            // Validate month is between 1 and 12
            const isValidMonth = /^\d{2}$/.test(month) && parseInt(month, 10) >= 1 && parseInt(month, 10) <= 12;

            // Validate year is equal to or greater than current year
            const isValidYear = /^\d{2}$/.test(year) && parseInt(year, 10) >= currentYear;

            let isValidDate = false;

            if (isValidMonth && isValidYear) {
                const expYear = parseInt(year, 10);
                const expMonth = parseInt(month, 10);

                if (expYear > currentYear || (expYear === currentYear && expMonth >= currentMonth)) {
                    isValidDate = true;
                }
            }

            if (!isValidDate) {
                // Handle invalid input (e.g., show error message, disable form submission)
                console.log('Invalid expiration date');
                alert('Invalid expiration date');
                document.getElementById("credit-card-exp").value = '';
                // Optionally, you can clear the input field or show an error message
                // creditCardExp.value = '';
            }
        }


        // Event listener for onchange
        creditCardExp.addEventListener("change", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            validateExpirationDate(inputValue);
        });


        creditCardCcv.addEventListener("input", function () {
            const inputValue = this.value.replace(/\D/g, ''); // Remove all non-digits
            const formattedValue = formatCVV(inputValue);
            this.value = formattedValue;
        });
    });

    function formatCreditCard(value) {
        const groups = value.match(/(\d{1,4})/g) || [];
        return groups.join(' ');
    }

    function formatExpirationDate(value) {
        const groups = value.match(/(\d{1,2})/g) || [];
        return groups.join('/').slice(0, 5);
    }

    function formatCVV(value) {
        return value.slice(0, 3);
    }
</script>