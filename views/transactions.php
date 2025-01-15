<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            .income {
            color: green;
            }

            .expense {
                color: red;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $record): ?>
                    <tr>
                        <td><?= htmlspecialchars(format_date($record['Date'])); ?></td>
                        <td><?= htmlspecialchars($record['Check #']); ?></td>
                        <td><?= htmlspecialchars($record['Description']); ?></td>
                        <td class="<?= strpos($record['Amount'], '-') === 0 ? 'expense' : 'income'; ?>">
                            <?= htmlspecialchars($record['Amount']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td >
                        <p class="income"><?= htmlspecialchars($totals['totalIncome'])?></p>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td >
                        <p class="expense"><?= htmlspecialchars($totals['totalExpense'])?></p>
                    </td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td>
                        <p class="<?= $totals['netTotal'] >= 0 ? 'income' : 'expense'; ?>">
                        <?= htmlspecialchars($totals['netTotal']); ?>
                        </p>
                    </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
