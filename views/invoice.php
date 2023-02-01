<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Invoice Page

    <?php if(!empty($invoice)): ?>
        <h1>Invoice #<?= $invoice['id'] ?></h1>
        <p>Amount: <?= $invoice['amount'] ?></p>
        <p>Full Name: <?= $invoice['full_name'] ?></p>
    <?php else: ?>
        <p>Invoice not found</p>
    <?php endif; ?>
    
</body>
</html>