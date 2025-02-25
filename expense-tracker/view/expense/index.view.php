<?php require base_path('view/partials/head.php'); ?>
<?php require base_path('view/partials/banner.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        $("#expense_date").val(today); // Set it as default value
    });
</script>

<!-- Expense Form -->
<div class="flex justify-center mt-10">
    <div class="bg-[#f7fafc] p-6 rounded-xl shadow-lg w-11/12 max-w-md">
        <h2 class="text-xl font-semibold mb-4 text-[#2b6cb0]">Add Expense</h2>
        <form id="expenseForm" action="/expense" method="POST">
            <input
                type="text"
                id="expense_name"
                name="expense_name"
                class="w-full p-3 border border-[#2b6cb0] rounded-lg focus:ring-2 focus:ring-[#2c5282] mb-4"
                placeholder="Expense Name"
                required
            />
            <input
                type="number"
                id="amount"
                name="amount"
                class="w-full p-3 border border-[#2b6cb0] rounded-lg focus:ring-2 focus:ring-[#2c5282] mb-4"
                placeholder="Amount"
                required
            />

            <?php if (count($groups) === 0): ?>
                <input
                    type="text"
                    id="group_id"
                    class="w-full p-3 border border-red-500 rounded-lg focus:ring-2 focus:ring-red-600 mb-4"
                    placeholder="No Group Found"
                    disabled
                />
            <?php else: ?>
                <select id="group-Name" name="group_id" class="w-full p-3 border border-[#2b6cb0] rounded-lg focus:ring-2 focus:ring-[#2c5282] mb-4" required>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?= $group['id'] ?>">
                            <?= htmlspecialchars($group['group_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <input
                type="date"
                id="expense_date"
                name="expense_date"
                class="w-full p-3 border border-[#2b6cb0] rounded-lg focus:ring-2 focus:ring-[#2c5282] mb-4"
                required
            />

            <div class="flex justify-end gap-2">
                <a href='/'
                    class="bg-gray-200 text-[#2b6cb0] px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-[#2b6cb0] text-white px-4 py-2 rounded-lg hover:bg-[#2c5282] transition">
                    Add Expense
                </button>
            </div>
        </form>
    </div>
</div>

<?php require base_path('view/partials/footer.php'); ?>
