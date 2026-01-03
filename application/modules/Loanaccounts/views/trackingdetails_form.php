<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Details Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .section {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
        }
        .section h3 {
            margin-bottom: 10px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        label {
            width: 150px;
            font-weight: bold;
        }
        input[type="file"],
        input[type="text"] {
            flex: 1;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .reset-btn {
            background-color: #ccc;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<form action="<?php echo base_url().'Loanaccounts/insertTrackingDetails'; ?>" name="trackingdetails_submit" id="trackingdetails_submit" method="post" enctype="multipart/form-data">

<div class="container">
    <h2>Tracking Details Info</h2>

    <!-- Cibil Details -->
    <div class="section">
        <h3>Cibil Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="cibil1file">
            <input type="text" name="cibil1description" placeholder="Description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="cibil2file">
            <input type="text" placeholder="Description" name="cibil2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="cibil3file">
            <input type="text" placeholder="Description" name="cibil3description">
        </div>
    </div>

    <!-- Fast Tag Details -->
    <div class="section">
        <h3>Fast Tag Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="fasttag1file">
            <input type="text" placeholder="Description" name="fasttag1description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="fasttag2file">
            <input type="text" placeholder="Description" name="fasttag2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="fasttag3file">
            <input type="text" placeholder="Description" name="fasttag1description">
        </div>
    </div>

    <!-- Gas Details -->
    <div class="section">
        <h3>Gas Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="gas1file">
            <input type="text" placeholder="Description" name="gas1description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="gas2file">
            <input type="text" placeholder="Description" name="gas2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="gas3file">
            <input type="text" placeholder="Description" name="gas3description">
        </div>
    </div>

    <!-- Internet Details -->
    <div class="section">
        <h3>Internet Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="internet1file">
            <input type="text" placeholder="Description" name="internet1description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="internet2file">
            <input type="text" placeholder="Description" name="internet2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="internet3file">
            <input type="text" placeholder="Description" name="internet3description">
        </div>
    </div>

    <!-- E-Commerce Details -->
    <div class="section">
        <h3>E-Commerce Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="ecommerce1file">
            <input type="text" placeholder="Description" name="ecommerce1description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="ecommerce2file">
            <input type="text" placeholder="Description" name="ecommerce2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="ecommerce3file">
            <input type="text" placeholder="Description" name="ecommerce3description">
        </div>
    </div>
     <!-- Other Details -->
    <div class="section">
        <h3>Other Details</h3>
        <div class="form-group">
            <label>File 1:</label>
            <input type="file" name="other1file">
            <input type="text" placeholder="Description" name="other1description">
        </div>
        <div class="form-group">
            <label>File 2:</label>
            <input type="file" name="other2file">
            <input type="text" placeholder="Description" name="other2description">
        </div>
        <div class="form-group">
            <label>File 3:</label>
            <input type="file" name="other3file">
            <input type="text" placeholder="Description" name="other3description">
        </div>
    </div>
    <input type="hidden" name="loan_id" value="<?php echo $loan_id; ?>">
    <!-- Buttons -->
    <div class="buttons">
        
        <button class="reset-btn" type="reset">Reset</button>
        <button class="submit-btn" type="submit">Submit</button>
    </div>

</div>
</form>

</body>
</html>
