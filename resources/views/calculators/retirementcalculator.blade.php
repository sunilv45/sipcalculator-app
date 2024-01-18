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
            {{--<form id="sipForm" class="col-md-6 bg-light p-4 rounded shadow">
                @csrf
                <h5 class="mb-3">SIP Amount needed to reach target</h5>
                <div class="mb-3">
                    <label for="target" class="form-label">Target Amount (Rs):</label>
                    <input type="text" id="target" name="target" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="existing_investment" class="form-label">Existing Investment (Rs):</label>
                    <input type="text" id="existing_investment" name="existing_investment" value="0"
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="years" class="form-label">Number of years to target:</label>
                    <input type="text" id="years" name="years" value="5" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="returns" class="form-label">Expected returns from investments:</label>
                    <input type="text" id="returns" name="returns" value="12" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
                <div id="result" class="mt-4 p-4 bg-light">
                    <h4 class="text-2xl font-semibold mb-4">Result</h4>
                    <p>Future value of existing investments: <span id="amtInvested" class="d-inline-block text-break">0</span></p>
                    <p>Monthly investment needed (Rs): <span id="formattedMonthlyInvestment" class="d-inline-block text-break">0</span></p>
                </div>
            </form>--}}
            <form id="retirementForm" class="col-md-6 bg-light p-4 rounded shadow">
                @csrf
                <!-- Step 1: Basic Information -->
                <div class="step" id="step1">
                    <h2 class="text-2xl font-semibold mb-4">Step 1: Basic Information</h2>
                    <div class="form-group">
                        <label for="monthly">Current Monthly Expenses (Rs):</label>
                        <input type="text" id="monthly" name="monthly" class="form-control" value="50000">
                    </div>
                    <div class="form-group">
                        <label for="current_age">Current Age:</label>
                        <input type="text" id="current_age" name="current_age" class="form-control" value="30">
                    </div>
                    <div class="form-group">
                        <label for="retire_age">Retirement Age:</label>
                        <input type="text" id="retire_age" name="retire_age" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="life_span">Expected Life Span:</label>
                        <select id="life_span" name="life_span" class="form-control">
                            <option value="75">75</option>
                            <option value="80" selected>80</option>
                            <option value="85">85</option>
                            <option value="90">90</option>
                            <option value="95">95</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <button type="button" onclick="nextStep('step1', 'step2')" class="btn btn-primary">Next</button>
                </div>
        
                <!-- Step 2: Investment Information -->
                <div class="step" id="step2" style="display:none;">
                    <h2 class="text-2xl font-semibold mb-4">Step 2: Investment Information</h2>
                    <div class="form-group">
                        <label for="current_investments">Current Value of Existing Investments (Rs):</label>
                        <input type="text" id="current_investments" name="current_investments" class="form-control" value="0">
                    </div>
                    <div class="form-group">
                        <label for="inflation">Expected Inflation:</label>
                        <select id="inflation" name="inflation" class="form-control">
                            <option value="4">4%</option>
                            <option value="4.5">4.5%</option>
                            <option value="5">5%</option>
                            <option value="5.5">5.5%</option>
                            <option value="6" selected>6%</option>
                            <option value="6.5">6.5%</option>
                            <option value="7">7%</option>
                            <option value="7.5">7.5%</option>
                            <option value="8">8%</option>
                            <option value="8.5">8.5%</option>
                            <option value="9">9%</option>
                            <option value="9.5">9.5%</option>
                            <option value="10">10%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="post_returns">Post-Retirement Investment Return:</label>
                        <select id="post_returns" name="post_returns" class="form-control">
                            <option value="5">5%</option>
                            <option value="5.5">5.5%</option>
                            <option value="6">6%</option>
                            <option value="6.5">6.5%</option>
                            <option value="7">7%</option>
                            <option value="7.5">7.5%</option>
                            <option value="8">8%</option>
                            <option value="8.5">8.5%</option>
                            <option value="9">9%</option>
                            <option value="9.5">9.5%</option>
                            <option value="10" selected>10%</option>
                            <option value="10.5">10.5%</option>
                            <option value="11">11%</option>
                            <option value="11.5">11.5%</option>
                            <option value="12">12%</option>
                            <option value="12.5">12.5%</option>
                            <option value="13">13%</option>
                            <option value="13.5">13.5%</option>
                            <option value="14">14%</option>
                            <option value="14.5">14.5%</option>
                            <option value="15">15%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pre_returns">Pre-Retirement Investment Return:</label>
                        <select id="pre_returns" name="pre_returns" class="form-control">
                            <option value="7">7%</option>
                            <option value="7.5">7.5%</option>
                            <option value="8">8%</option>
                            <option value="8.5">8.5%</option>
                            <option value="9">9%</option>
                            <option value="9.5">9.5%</option>
                            <option value="10" selected>10%</option>
                            <option value="10.5">10.5%</option>
                            <option value="11">11%</option>
                            <option value="11.5">11.5%</option>
                            <option value="12">12%</option>
                            <option value="12.5">12.5%</option>
                            <option value="13">13%</option>
                            <option value="13.5">13.5%</option>
                            <option value="14">14%</option>
                            <option value="14.5">14.5%</option>
                            <option value="15">15%</option>
                        </select>
                    </div>
                    <button type="button" onclick="prevStep('step2', 'step1')" class="btn btn-secondary">Previous</button>
                    <button type="button" onclick="nextStep('step2', 'step3')" class="btn btn-primary">Next</button>
                </div>

        
                <!-- Step 3: Results -->
                <div class="step" id="step3" style="display:none;">
                    <h2 class="text-2xl font-semibold mb-4">Step 3: Results</h2>
                    <p id="calculationResult">Calculated result will be displayed here</p>
                    {{-- <button type="button" onclick="calculateRetirement()" class="btn btn-primary">Calculate</button> --}}
                    <a href="{{ route('retirementcalculator.show') }}" class="btn btn-success">Done</a>
                    <button type="button" onclick="prevStep('step3', 'step2')" class="btn btn-secondary">Previous</button>
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
    <!-- Add this script to the end of your HTML body -->
    <script>
        function nextStep(currentStep, nextStep) {
            //console.log("step func"+nextStep);
            document.getElementById(currentStep).style.display = 'none';
            document.getElementById(nextStep).style.display = 'block';

            if (nextStep === 'step3') {
                // Automatically calculate retirement on transitioning to Step 3
                calculateRetirement();
            }
        }

        function prevStep(currentStep, prevStep) {
            document.getElementById(currentStep).style.display = 'none';
            document.getElementById(prevStep).style.display = 'block';
        }

        function calculateRetirement() {
            //console.log("cal func"+'step3');
        // Fetch form values
        var monthly = parseFloat(document.getElementById('monthly').value) || 0;
        var current_age = parseFloat(document.getElementById('current_age').value) || 0;
        var retire_age = parseFloat(document.getElementById('retire_age').value) || 0;
        var life_span = parseFloat(document.getElementById('life_span').value) || 0;
        var current_investments = parseFloat(document.getElementById('current_investments').value) || 0;
        var inflation = parseFloat(document.getElementById('inflation').value) || 0;
        var post_returns = parseFloat(document.getElementById('post_returns').value) || 0;
        var pre_returns = parseFloat(document.getElementById('pre_returns').value) || 0;
        console.log("monthly"+monthly);
        console.log("current_age"+current_age);
        console.log("retire_age"+retire_age);
        console.log("life_span"+life_span);
        console.log("current_investments"+current_investments);
        console.log("inflation"+inflation);
        console.log("post_returns"+post_returns);
        console.log("pre_returns"+pre_returns);

        // Calculate retire_period, monthly_post_ret, total_corpus, future_value, corpus_required, years_left, and monthly_investment
        var retire_period = life_span - retire_age;
        var monthly_post_ret = Math.round(monthly * Math.pow((1 + (inflation / 100)), (retire_age - current_age)));
        var total_corpus = Math.round(monthly_post_ret * (1 + (Math.pow((1 + (post_returns / 100) * 3 / 12), 4) - 1) * 100 / 100) / (((Math.pow((1 + (post_returns / 100) * 3 / 12), 4) - 1) * 100 / 100) - (((Math.pow(1 + (inflation / 100), 1 / 12)) - 1) * 100 / 100)) * (1 - Math.pow((1 + (((Math.pow(1 + (inflation / 100), 1 / 12)) - 1) * 100 / 100)) / (1 + (((Math.pow(1 + (post_returns / 100) * 3 / 12), 4) - 1) * 100 / 100))), (life_span - retire_age) * 12));
        var future_value = Math.round(current_investments * Math.pow((1 + pre_returns / 100), (retire_age - current_age)));
        var corpus_required = total_corpus - future_value;
        var years_left = retire_age - current_age;
        var monthly_investment = Math.round((corpus_required * (pre_returns / 100) / 12) / ((Math.pow(1 + (pre_returns / 100) / 12), years_left * 12) - 1));

        // Display results
        document.getElementById('calculationResult').innerHTML = "Retire Period: " + retire_period +
            "<br>Monthly Post Retirement: " + monthly_post_ret +
            "<br>Total Corpus Needed: " + total_corpus +
            "<br>Future Value of Current Investments: " + future_value +
            "<br>Corpus Required: " + corpus_required +
            "<br>Years Left: " + years_left +
            "<br>Monthly Investment Needed: " + monthly_investment;

        // Show result section
        document.getElementById('step3').style.display = 'block';
    }
    </script>

</body>
</html>