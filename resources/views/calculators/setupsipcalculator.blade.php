<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sip Calculator</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Your additional styles or other CDN links go here -->
<style>
    .header-color {
        background-color: #ff725e;
    }
    .footer-color {
        background-color: #ff725e;
    }
</style>
</head>
<body>
    <header class="header-color text-light py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo on the left -->
                <div>
                    <img src="{{ asset('yourlogso.png') }}" alt="Sip Calculator" style="max-height: 50px;width:100%">
                </div>

                <!-- Contact and SIP menu on the right -->
                <div>
                    <a href="{{route('sip-calculator.index')}}" class="text-light mx-2">SIP</a>
                    <a href="#" class="text-light mx-2">Contact</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <img src="{{ asset('images/calculator.svg') }}" alt="Calculator Image">
            </div>
            <form id="stepUpSipForm" class="col-md-6 bg-light p-4 rounded shadow">
                @csrf
        
                <h5 class="mb-3">Step-up SIP Value Calculator</h5>
        
                <div class="mb-3">
                    <label for="monthly" class="form-label">My monthly investment (Rs):</label>
                    <input type="text" id="monthly" name="monthly" value="0" class="form-control" onkeyup="calculateStepUpSip()">
                </div>
            
                <div class="mb-3">
                    <label for="step" class="form-label">Annual increase (Rs):</label>
                    <input type="text" id="step" name="step" value="0" class="form-control" onkeyup="calculateStepUpSip()">
                </div>
            
                <div class="mb-3">
                    <label for="current" class="form-label">Existing amount (Rs):</label>
                    <input type="text" id="current" name="current" value="0" class="form-control" onkeyup="calculateStepUpSip()">
                </div>
            
                <div class="mb-3">
                    <label for="years" class="form-label">Number of years I plan to invest:</label>
                    <input type="text" id="years" name="years" value="0" class="form-control" onkeyup="calculateStepUpSip()">
                </div>
        
                <div class="mb-3">
                    <label for="returns" class="form-label">Expected returns (Annual, CAGR):</label>
                    <select id="returns" name="returns" class="form-control" onchange="calculateStepUpSip()">
                        <!-- Add the provided options for Expected returns -->
                        <option value="7">7%</option>
                        <option value="7.5">7.5%</option>
                        <option value="8">8%</option>
                        <option value="8.5">8.5%</option>
                        <option value="9">9%</option>
                        <option value="9.5">9.5%</option>
                        <option value="10">10%</option>
                        <option value="10.5">10.5%</option>
                        <option value="11">11%</option>
                        <option value="11.5">11.5%</option>
                        <option value="12" selected>12%</option>
                        <option value="12.5">12.5%</option>
                        <option value="13">13%</option>
                        <option value="13.5">13.5%</option>
                        <option value="14">14%</option>
                        <option value="14.5">14.5%</option>
                        <option value="15">15%</option>
                        <option value="16">16%</option>
                        <option value="17">17%</option>
                        <option value="18">18%</option>
                        <option value="19">19%</option>
                        <option value="20">20%</option>
                    </select>
                </div>
        
                <div class="mb-3">
                    <label for="totalInvestment" class="form-label">Total amount invested (Rs):</label>
                    <input type="text" id="totalInvestment" name="totalInvestment" readonly class="form-control">
                </div>
            
                <div class="mb-3">
                    <label for="stepUpSipValue" class="form-label">Value of step-up SIP at the end of period (Rs):</label>
                    <input type="text" id="stepUpSipValue" name="stepUpSipValue" readonly class="form-control">
                </div>
        
            </form>
            
        </div>
    </div>
    <footer class="header-color text-light py-3 mt-3">
        <div class="container text-center">
            <p>&copy; 2023 Sip Calculator. All rights reserved.</p>
        </div>
    </footer>
    <!-- Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to calculate SWP
        function calculateStepUpSip() {
            let monthly = parseInt(document.getElementById('monthly').value);
            let step = parseInt(document.getElementById('step').value);
            let current = parseInt(document.getElementById('current').value);
            let years = parseInt(document.getElementById('years').value);
            let returns = parseFloat(document.getElementById('returns').value);

            let rate = Math.pow((1 + returns / 100), (1 / 12)) - 1;

            if (!monthly || !years || !returns) {
                document.getElementById('totalInvestment').value = 0;
                document.getElementById('stepUpSipValue').value = 0;
                return;
            }

            if (!step) {
                step = 0;
            }

            let df = [];
            for (let i = 0; i < years; i++) {
                for (let j = 0; j < 12; j++) {
                    let row = (i * 12) + j;
                    if (i === 0 && j === 0) {
                        df[0] = [];
                        df[0][0] = 1;
                        df[0][1] = 1;
                        df[0][2] = monthly;
                        df[0][3] = current + monthly;
                        df[0][4] = current + monthly;
                    } else {
                        if (j === 0) {
                            df[row] = [];
                            df[row][0] = df[row - 1][0] + 1;
                            df[row][1] = j + 1;
                            df[row][2] = df[row - 1][2] + (step);
                            df[row][3] = df[row - 1][3] + df[row][2];
                            df[row][4] = (df[row - 1][4] * (1 + rate)) + df[row][2];
                        } else {
                            df[row] = [];
                            df[row][0] = df[row - 1][0];
                            df[row][1] = j + 1;
                            df[row][2] = df[row - 1][2];
                            df[row][3] = df[row - 1][3] + df[row][2];
                            df[row][4] = (df[row - 1][4] * (1 + rate)) + df[row][2];
                        }
                    }
                }
            }

            let formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0,
            });

            let totalInvestment = df[df.length - 1][3];
            let stepUpSipValue = df[df.length - 1][4];

            document.getElementById('totalInvestment').value = formatter.format(totalInvestment);
            document.getElementById('stepUpSipValue').value = formatter.format(stepUpSipValue);
        }

    </script>
</body>
</html>