<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>

<!-- Group Wise Data Section -->
<div class="flex justify-center mt-10">
    <div class="bg-[#F9FAFB] p-8 rounded-2xl shadow-xl w-11/12 max-w-4xl">
        <h2 class="text-3xl font-bold mb-6 text-[#1D3557] text-center">
            Group Wise Expenses
        </h2>

        <!-- Expense Table -->
        <div class="overflow-x-auto">
            <?php if (!$expenses): ?>
                <p class="text-center text-[#6B7280] text-lg">No expenses found for this group.</p>
            <?php else: ?>
                <table class="min-w-full bg-[#FFFFFF] shadow-md rounded-lg border-collapse">
                    <thead class="bg-[#1D3557] text-white">
                        <tr>
                            <th class="p-4 text-left uppercase tracking-wide">Expense Name</th>
                            <th class="p-4 text-left uppercase tracking-wide">Amount (₹)</th>
                            <th class="p-4 text-left uppercase tracking-wide">Date</th>
                            <th class="p-4 text-left uppercase tracking-wide">Edit</th>
                            <th class="p-4 text-left uppercase tracking-wide text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#374151]">
                        <?php foreach ($expenses as $expense): ?>
                            <tr class="border-b hover:bg-[#E5E7EB] transition">
                                <td class="p-4"><?= htmlspecialchars($expense['expense_name']) ?></td>
                                <td class="p-4 font-semibold text-[#1D3557]">
                                    ₹<?= number_format($expense['amount'], 2) ?>
                                </td>
                                <td class="p-4"><?= htmlspecialchars($expense['formatted_date']) ?></td>
                                <td class="p-3 text-left">
                                    <a href="/expense/edit?id=<?= $expense['id'] ?>" class="bg-[#1D3557] text-white px-4 py-2 rounded-lg hover:bg-[#457B9D] transition">
                                        Edit
                                    </a>
                                <td class="p-4 text-center">
                                    <form action="/expense" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                                        <button type="submit" class="bg-[#E63946] hover:bg-[#D62828] text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <!-- Footer Section -->
        <div class="flex justify-between items-center mt-6 border-t pt-4">
            <span class="text-xl font-bold text-[#1D3557]">
                Total Expenses: ₹<?= number_format(array_sum(array_column($expenses, 'amount')), 2) ?>
            </span>
            <a href="/" class="bg-[#1D3557] text-white px-6 py-2 rounded-lg shadow hover:bg-[#457B9D] transition">
                Back
            </a>
        </div>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
